<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use App\Form;
use App\Schoolclass;
use App\Voter;
use App\Candidate;
use App\Terminal;
use Illuminate\Support\Facades\DB;

class electionProcessController extends Controller
{

    public function vote($candidateUUID, $voterUUID) {
        try {
          $candidate = Candidate::find(Self::getId($candidateUUID, 'candidates'));
          $candidate->votes = $candidate->votes + 1;
          $candidate->save();

          $voter = Voter::find(Self::getId($voterUUID, 'voters'));
          $voter->voted_via_terminal = true;
          $voter->save();

          //// TODO: Add security things
        } catch (\Exception $e) {
          return 'fatal error';
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
        return 'error';
      }
    }
}
