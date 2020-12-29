<?php

namespace App\Http\Controllers\electiontypes;

use App\Http\Controllers\electionProcessController;
use Bugsnag;
use Illuminate\Http\Request;
use App\Election;
use App\Form;
use App\Schoolclass;
use App\Voter;
use App\Candidate;
use App\Terminal;

class spv extends electionProcessController
{

  public function getId($uuid, $table) {
    try {
      switch ($table) {
        case 'forms':
          return Form::where('uuid', $uuid)->firstOrFail()->id;
          break;
        case 'classes':
          return Schoolclass::where('uuid', $uuid)->firstOrFail()->id;
          break;
        default:
          return electionProcessController::getId($uuid, $table);
          break;
      }
    } catch (\Exception $e) {
        Bugsnag::notifyException($e);
    }
  }

  public function querrySchoolForms() {
    try {
      $election = Election::where('uuid', $this->electionUUID)->firstOrFail();
      $forms = Form::getWithActive($election->id);

      return $forms;

    } catch (\Exception $e) {
        Bugsnag::notifyException($e);
    }

  }

  public function querrySchoolClassesInForm($formUUID) {
    try {
      $schoolClasses = Schoolclass::getWithActive(Self::getId($formUUID, 'forms'));
      return $schoolClasses;
    } catch (\Exception $e) {
        Bugsnag::notifyException($e);
    }

  }

  public function querryStudentsInClasses($classUUID) {
    try {
      $students = Voter::where('schoolclass_id', Self::getId($classUUID, 'classes'))->where([
        ['voted_via_terminal', '=', '0'],
        ['voted_via_email', '=', '0'],
        ])->get();

      return $students;
    } catch (\Exception $e) {
        Bugsnag::notifyException($e);
    }

  }

  public function querryStudentData($studentUUID) {
    try {
      $student = Voter::find(Self::getId($studentUUID, 'voters'));

      return $student;
    } catch (\Exception $e) {
        Bugsnag::notifyException($e);
    }

  }

  public function getThem() {
    $voters = Form::getWithActive(1);
    return $voters;
  }

}
