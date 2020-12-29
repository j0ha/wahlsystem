<?php

namespace App\Http\Controllers;

use App\Election;
use App\Voter;
use App\Candidate;
use App\Terminal;
use Bugsnag;


class electionProcessController extends Controller
{
    private $securityreporter;
    protected $electionUUID;
    private $securityController;
    private $terminalController;
    protected $election;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityreporter = new securityreporterController($this->electionUUID);
        $this->securityController = new securityController($this->electionUUID);
        $this->terminalController = new terminalController($this->electionUUID);
        $this->election = Election::where('uuid', $this->electionUUID)->firstOrFail();
    }

    public function vote($candidateUUID, $voterUUID, $terminalUUID) {
        try {
            if ($this->election->manual_voter_activation == true) {
                $isallowed = $this->securityController->extendedVoteVerification($this->spv_voter_uuid);
            } else {
                $isallowed = $this->securityController->voteVerification($this->spv_voter_uuid);
            }

          $candidatebelongsto = $this->securityController->verifyToElection('candidate', $candidateUUID);
          $terminalAccess = $this->terminalController->verifyTerminalAcces($this->electionUUID, $terminalUUID);

          if($isallowed == true and $candidatebelongsto == true and $terminalAccess == true){
            $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

            $voter = Voter::find(Self::getId($voterUUID, 'voters'));
            switch ($terminal->kind) {
              case config('terminalkinds.normal.short'):
                $voter->voted_via_terminal = true;
                break;
              case config('terminalkinds.email.short'):
                $voter->voted_via_email = true;
                break;
              default:
                Bugsnag::leaveBreadcrumb('worng terminal type was detected at vote function', ['terminalKind'=>$terminal->kind]);
                $this->securityreporter->report('worng terminal type was detected at vote function',1, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, null);
                return false;
            }

            $voter->save();
            Self::voteAgent($candidateUUID);
            $this->terminalController->hit($terminalUUID);
          } else {
              $this->securityreporter->report('vote failed',3, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, null);
          }
          // TODO: Add security things
        } catch (\Exception $e) {
            $this->securityreporter->report('vote failed',3, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, $e);
            Bugsnag::notifyException($e);
        }

    }

    private function voteAgent($candidateUUID) {
      try {
        $candidate = Candidate::find(Self::getId($candidateUUID, 'candidates'));
        $candidate->votes = $candidate->votes + 1;
        $candidate->save();

        // TODO: safeties!!!
      } catch (\Exception $e) {
          $this->securityreporter->report('vote failed',1, get_class(),'CandidateUUID: '. $candidateUUID, $e);
          Bugsnag::notifyException($e);
      }
    }

    public function querryElectionCandidates($electionUUID) {
      try {
        $candidates = Candidate::where('election_id', Self::getId($electionUUID, 'elections'))->get();

        return $candidates;
      } catch (\Exception $e) {
          Bugsnag::notifyException($e);
      }

    }

    public function getId($uuid, $table) {
      try {
        switch ($table) {
          case 'voters':
            return Voter::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'terminals':
            return Terminal::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'elections':
            return Election::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'candidates':
            return Candidate::where('uuid', $uuid)->firstOrFail()->id;
            break;
          default:
            return 'error';
            break;
        }
      } catch (\Exception $e) {
          Bugsnag::notifyException($e);
      }
    }
}
