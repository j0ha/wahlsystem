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
    public function __construct()
    {
        $this->securityreporter = new securityreporterController('39dd732f-8e44-42a7-bdb3-96187f8c5846');

        //Todo change to OOP
    }

    public function verifyToElection($thing, $UUID, $electionUUID) {
      switch ($thing) {
        case 'voter':
          $voter = Voter::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($voter->election_id);

          if($election->uuid == $electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'voter_direct':
        $voter_direct = Voter::where('direct_uuid', $UUID)->firstOrFail();
        $election = Election::find($voter_direct->election_id);

        if($election->uuid == $electionUUID) {
          return true;
        } else {
          return false;
        }
          break;
        case 'candidate':
          $candidate = Candidate::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($candidate->election_id);

          if($election->uuid == $electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'schoolclass':
          $schoolclass = Schoolclass::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($schoolclass->election_id);

          if($election->uuid == $electionUUID) {
            return true;
          } else {
            return false;
          }
          break;
        case 'form':
          $form = Form::where('uuid', $UUID)->firstOrFail();
          $election = Election::find($form->election_id);

          if($election->uuid == $electionUUID) {
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

    public function safetyTables($electionUUID, $candidateUUID) {
      Self::thirdSafetyTableUpdate($candidateUUID);
      Self::fourthSafetyTableUpdate($electionUUID, $candidateUUID);
    }

    private function thirdSafetyTableUpdate($candidateUUID) {
      $candidate = thirdSafety::where('candidate_uuid', $candidateUUID)->firstOrFail();
      $candidate->candidate_value = $candidate->candidate_value + 1;
      $candidate->save();
    }

    private function fourthSafetyTableUpdate($electionUUID, $candidateUUID) {
      $result = new FourthSafety;
      $result->election_id = $electionUUID;
      $result->candidate_uuid = $candidateUUID;
      $reuslt->save();
    }

    public function initializeSafety($electionUUID, $candidatesUUID) {
      Self::initializeThirdSafety($electionUUID, $candidates);
    }

    private function initializeThirdSafety($electionUUID, $candidatesUUID) {
      foreach ($candidates as $candidateData) {
        $thirdSafety = new thirdSafety;
        $thirdSafety->election_uuid = $electionUUID;
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
}
