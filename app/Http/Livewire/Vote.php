<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\terminalController;
use App\Http\Controllers\securityController;
use App\Http\Controllers\electiontypes\spv;
use App\Election;
use Carbon\Carbon;

class Vote extends Component
{

    public $electionUUID;
    public $terminalUUID;
    public $state;
    public $election;
    public $spv_forms;
    public $spv_schoolclasses;
    public $spv_voters;
    public $spv_birthday_day;
    public $spv_birthday_month;
    public $spv_birthday_year;
    public $spv_candidates;

    public $spv_voter_uuid;

    public function mount($electionUUID, $terminalUUID) {
      $this->electionUUID = $electionUUID;
      $this->terminalUUID = $terminalUUID;
      $this->state = 'start';

      $this->election = Election::where('uuid', $electionUUID)->firstOrFail();

    }

    public function render()
    {
        return view('livewire.vote');

    }

    public function nextStep() {
      switch ($this->state) {
        case 'start' AND $this->election->type = 'spv':
          Self::spvOpenForms();
          break;
        case 'birth_verification' AND $this->election->type = 'spv':
          Self::validation();
          break;

        default:
          $this->state = 'start';
          break;
      }
    }

    private function spvOpenForms() {
      $this->electionProcessController = new spv;
      $this->spv_forms = $this->electionProcessController->querrySchoolForms($this->electionUUID);
      $this->state = 'forms';
    }

    public function spvOpenSchoolclasses($formUUID) {
      $securityController = new securityController;
      $electionProcessController = new spv;

      $isthere = $securityController->verifyToElection('form', $formUUID, $this->electionUUID);
      if($isthere == true) {
        $this->spv_schoolclasses = $electionProcessController->querrySchoolClassesInForm($formUUID);
        $this->state = 'schoolclasses';
      } else {
        //error handler
      }

    }

    public function spvOpenVoters($schoolclassUUID) {
      $securityController = new securityController;
      $electionProcessController = new spv;

      $isthere = $securityController->verifyToElection('schoolclass', $schoolclassUUID, $this->electionUUID);
      if($isthere == true) {
        $this->spv_voters = $electionProcessController->querryStudentsInClasses($schoolclassUUID);
        $this->state = 'voters';
      } else {
        //error handler
      }

    }

    public function spv_birthVerification($voterUUID) {
      $securityController = new securityController;
      $electionProcessController = new spv;



      $isthere = $securityController->verifyToElection('voter', $voterUUID, $this->electionUUID);
      if($isthere == true) {
        //// TODO: darf er wählen?
        $this->spv_voter_uuid = $voterUUID;
        $this->state = 'birth_verification';
      } else {
        //error handler
      }

    }

    protected $rules = [
        'spv_birthday_day' => 'required|numeric|between:01,31',
        'spv_birthday_month' => 'required|numeric|between:01,12',
        'spv_birthday_year' => 'required|numeric|digits:4|between:0001,9999',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function validation() {
      $this->validate();
      $securityController = new securityController;
      $electionProcessController = new spv;
      $this->spv_candidates = $electionProcessController->querryElectionCandidates($this->electionUUID);

      // TODO: darf er wählen?
      $votersdata = $electionProcessController->querryStudentData($this->spv_voter_uuid);


      //typed in birthday
      $birthday_typed = new Carbon($this->spv_birthday_year.'-'.$this->spv_birthday_month.'-'.$this->spv_birthday_day);
      //birthday in database
      $birthday_database = new Carbon($votersdata->birth_year);
      //compare the two dates
      if($birthday_typed->equalTo($birthday_database)) {


        $this->state = 'vote';
      }
    }

}
