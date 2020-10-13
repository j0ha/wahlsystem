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
    public function querrySchoolForms($electtionUUID) {
      try {
        $election = Election::where('uuid', $electtionUUID)->firstOrFail();
        $forms = Form::where('election_id', $election->id)->get();

        return $forms;

      } catch (\Exception $e) {

        return 'error';
      }

    }

    public function querrySchoolClassesInForm($formUUID) {
      try {
        $schoolClasses = Schoolclass::where('form_id', Self::getId($formUUID, 'forms'))->get();

        return $schoolClasses;
      } catch (\Exception $e) {
        return 'error';
            }

    }

    public function querryStudentsInClasses($classUUID) {
      try {
        $students = Voter::where('schoolclass_id', Self::getId($classUUID, 'classes'))->get();

        return $students;
      } catch (\Exception $e) {
        return 'error';
      }

    }

    public function querryStudentData($studentUUID) {
      try {
        $student = Voter::find(Self::getId($studentUUID, 'voters'));

        return $student;
      } catch (\Exception $e) {
        return 'error';
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

    public static function getId($uuid, $table) {
      try {
        switch ($table) {
          case 'voters':
            return Voter::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'terminals':
            return Terminal::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'forms':
            return Form::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'classes':
            return Schoolclass::where('uuid', $uuid)->firstOrFail()->id;
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
