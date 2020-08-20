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
        $voter_direct = Voter::where('uuid_direct', $UUID)->firstOrFail();
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
}
