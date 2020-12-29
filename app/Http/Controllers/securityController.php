<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThirdSafety;
use App\FourthSafety;
use App\Voter;
use App\Candidate;
use App\Schoolclass;
use App\Form;
use App\Election;

class securityController extends Controller
{

    private $securityreporter;
    private $electionUUID;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityreporter = new securityreporterController($this->electionUUID);
    }

    public function verifyToElection($thing, $UUID) {
      switch ($thing) {
        case 'voter':
          $voter = Voter::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($voter->election_id);

          if($election->uuid == $this->electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'voter_direct':
        $voter_direct = Voter::where('direct_uuid', $UUID)->firstOrFail();
        $election = Election::find($voter_direct->election_id);

        if($election->uuid == $this->electionUUID) {
          return true;
        } else {
          return false;
        }
          break;
        case 'candidate':
          $candidate = Candidate::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($candidate->election_id);

          if($election->uuid == $this->electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'schoolclass':
          $schoolclass = Schoolclass::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($schoolclass->election_id);

          if($election->uuid == $this->electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'form':
          $form = Form::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($form->election_id);

          if($election->uuid == $this->electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        default:
          return false;
          break;
      }
    }

    public function safetyTables($candidateUUID) {
      Self::thirdSafetyTableUpdate($candidateUUID);
      Self::fourthSafetyTableUpdate($this->electionUUID, $candidateUUID);
    }

    private function thirdSafetyTableUpdate($candidateUUID) {
      $candidate = thirdSafety::where('candidate_uuid', $candidateUUID)->firstOrFail();
      $candidate->candidate_value = $candidate->candidate_value + 1;
      $candidate->save();
    }

    private function fourthSafetyTableUpdate($candidateUUID) {
      $result = new FourthSafety;
      $result->election_id = $this->electionUUID;
      $result->candidate_uuid = $candidateUUID;
      $result->save();
    }

    public function initializeSafety($candidatesUUID) {
      Self::initializeThirdSafety($this->electionUUID, $candidatesUUID);
    }

    private function initializeThirdSafety($candidatesUUID) {
      foreach ($candidates as $candidateData) {
        $thirdSafety = new thirdSafety;
        $thirdSafety->election_uuid = $this->electionUUID;
        $thirdSafety->candidate_uuid = $candidateData->uuid;
        $thirdSafety->candidate_value = 0;
      }
    }
    public function voteVerification($voterUUID) {
      try {
        $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
        if($voter->voted_via_email == false AND $voter->voted_via_terminal == false) {
          return true;
        } else {
            $this->securityreporter->report('voterVerification failed',2, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID, null);
          return false;
        }
      } catch (\Exception $e) {
          $this->securityreporter->report('voterVerification catched',2, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID, $e);
        return false;
      }
    }

    public function extendedVoteVerification($voterUUID) {
        try {
            $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
            if($voter->voted_via_email == false AND $voter->voted_via_terminal == false AND $voter->activated == true) {
                return true;
            } else {
                $this->securityreporter->report('voterVerification failed',2, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID, null);
                return false;
            }
        } catch (\Exception $e) {
            $this->securityreporter->report('voterVerification catched',2, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID, $e);
            return false;
        }
    }
}
