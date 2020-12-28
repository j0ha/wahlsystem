<?php

namespace App\Http\Controllers;

use App\Election;
use App\Voter;
use App\Candidate;
use App\Terminal;


class electionProcessController extends Controller
{
    private $securityreporter;
    protected $electionUUID;
    private $securityController;
    private $terminalController;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityreporter = new securityreporterController($this->electionUUID);
        $this->securityController = new securityController($this->electionUUID);
        $this->terminalController = new terminalController($this->electionUUID);
    }

    public function vote($candidateUUID, $voterUUID, $terminalUUID) {
        try {
          $isallowed = $this->securityController->voteVerification($voterUUID);
          $candidatebelongsto = $this->securityController->verifyToElection('candidate', $candidateUUID);
          $terminalAccess = $this->terminalController->verifyTerminalAcces($this->electionUUID, $terminalUUID);
          if($isallowed == true and $candidatebelongsto == true and $terminalAccess == true){
            $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

            $voter = Voter::find(Self::getId($voterUUID, 'voters'));
            switch ($terminal->kind) {
              case 'normal':
                $voter->voted_via_terminal = true;
                break;
              case 'email':
                $voter->voted_via_email = true;
                break;
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
      }
    }

    public function querryElectionCandidates($electionUUID) {
      try {
        $candidates = Candidate::where('election_id', Self::getId($electionUUID, 'elections'))->get();

        return $candidates;
      } catch (\Exception $e) {

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

      }
    }
}
