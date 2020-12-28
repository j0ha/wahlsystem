<?php

namespace App\Http\Controllers;

use App\Election;
use App\Form;
use App\Schoolclass;
use App\Voter;
use App\Candidate;
use App\Terminal;
use App\Http\Controllers\terminalController;
use App\Http\Controllers\securityController;
use Illuminate\Support\Facades\DB;

class electionProcessController extends Controller
{
    private $securityreporter;
    public function __construct()
    {
        $this->securityreporter = new securityreporterController('39dd732f-8e44-42a7-bdb3-96187f8c5846');

        //Todo change to OOP
    }

    public function vote($candidateUUID, $voterUUID, $terminalUUID, $electionUUID) {
        try {
          $securityController = new securityController;
          $terminalController = new terminalController;
          $isallowed = $securityController->voteVerification($voterUUID);
          $candidatebelongsto = $securityController->verifyToElection('candidate', $candidateUUID, $electionUUID);
          $terminalAccess = $terminalController->verifyTerminalAcces($electionUUID, $terminalUUID);
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
            $terminalController->hit($terminalUUID);
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
