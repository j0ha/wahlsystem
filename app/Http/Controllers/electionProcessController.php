<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            // TODO: error reporter
            // TODO: security repoter
          }
          // TODO: Add security things
        } catch (\Exception $e) {
          // TODO: Error reporter
          dd($e);
        }

    }

    private function voteAgent($candidateUUID) {
      try {
        $candidate = Candidate::find(Self::getId($candidateUUID, 'candidates'));
        $candidate->votes = $candidate->votes + 1;
        $candidate->save();

        // TODO: safeties!!!
      } catch (\Exception $e) {
        // TODO: error reporter
        // TODO: security reporter
        dd($e);
      }
    }

    public function querryElectionCandidates($electionUUID) {
      try {
        $candidates = Candidate::where('election_id', Self::getId($electionUUID, 'elections'))->get();

        return $candidates;
      } catch (\Exception $e) {
        return 'error';
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
        return $e;
      }
    }
}
