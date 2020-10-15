<?php

namespace App\Http\Controllers\electiontypes;

use App\Http\Controllers\electionProcessController;
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
      return 'error';
    }
  }

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

}
