<?php

namespace App\Http\Livewire;

use App\Http\Controllers\securityreporterController;
use App\Terminal;
use App\Voter;
use Bugsnag;
use Livewire\Component;
use App\Http\Controllers\terminalController;
use App\Http\Controllers\securityController;
use App\Http\Controllers\electiontypes\spv;
use App\Election;
use App\Candidate;
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
    public $spv_selected_candidate_uuid;
    public $spv_selected_candidate_name;
    public $spv_terminal_route;
    public $directUUID;
    public $terminal;

    public $spv_voter_uuid;


    public function mount($electionUUID, $terminalUUID, $directUUID) {
      $this->electionUUID = $electionUUID;
      $this->terminalUUID = $terminalUUID;
      $this->directUUID = $directUUID;

      $this->terminal = Terminal::where('uuid', $this->terminalUUID)->firstOrFail();
      $securityreporter = new securityreporterController($this->electionUUID);

      if($this->directUUID == null AND $this->terminal->kind == config('terminalkinds.normal.short')) {
          $this->spv_terminal_route = route('vote',['electionUUID'=>$electionUUID, 'terminalUUID'=>$terminalUUID]);
          $this->state = 'start';
      } elseif($this->directUUID != null AND $this->terminal->kind == config('terminalkinds.email.short')) {
          try {
              $securityController = new securityController($this->electionUUID);

              $isallowed = $securityController->verifyToElection('voter_direct', $this->directUUID);

              if($isallowed == true) {
                  $voter = Voter::where('direct_uuid', $this->directUUID)->firstOrFail();
                  $voteverification = $securityController->voteVerification($voter->uuid);
                  if($voteverification == true){
                      Self::spv_birthVerification($voter->uuid);
                  } else {
                      $securityreporter->report('give access faild at direct access',4, get_class(),'IP: '. \Request::getClientIp(), null);
                      $this->redirect(route('escape'));
                  }

              } else {
                  $securityreporter->report('tried access with wrong directUUID', 3, get_class(), 'IP: '.\Request::getClientIp(), null);
                  $this->redirect(route('escape'));
              }
          } catch(\Exception $e) {
              Bugsnag::notifyException($e);
              $this->redirect(route('escape'));
          }
        } else {
          $securityreporter->report('try to access terminal with wrong attributs.', 4, get_class(), 'IP: '.\Request::getClientIp(). ' Possible: try to open E-Mail terminal without direct_uuid', null);
          $this->redirect(route('escape'));
      }



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
      $electionProcessController = new spv($this->electionUUID);
      $this->spv_forms = $electionProcessController->querrySchoolForms();
      $this->state = 'forms';
    }

    public function spvOpenSchoolclasses($formUUID) {
      $securityController = new securityController($this->electionUUID);
      $electionProcessController = new spv($this->electionUUID);

      $isthere = $securityController->verifyToElection('form', $formUUID);
      if($isthere == true) {
        $this->spv_schoolclasses = $electionProcessController->querrySchoolClassesInForm($formUUID);
        $this->state = 'schoolclasses';
      } else {
        //error handler
      }

    }

    public function spvOpenVoters($schoolclassUUID) {
      $securityController = new securityController($this->electionUUID);
      $electionProcessController = new spv($this->electionUUID);

      $isthere = $securityController->verifyToElection('schoolclass', $schoolclassUUID);
      if($isthere == true) {
        $this->spv_voters = $electionProcessController->querryStudentsInClasses($schoolclassUUID);
        $this->state = 'voters';
      } else {
        //error handler
      }

    }

    public function spv_birthVerification($voterUUID) {
      $securityController = new securityController($this->electionUUID);

      $isthere = $securityController->verifyToElection('voter', $voterUUID);
      $isallowed = $securityController->voteVerification($voterUUID);
      if($isthere == true and $isallowed == true) {
        $this->spv_voter_uuid = $voterUUID;
        $this->state = 'birth_verification';
      } else {
          $securityreporter = new securityreporterController($this->electionUUID);
          $securityreporter->report('give access faild',4, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID, null);
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
      $securityController = new securityController($this->electionUUID);
      $electionProcessController = new spv($this->electionUUID);
      $this->spv_candidates = $electionProcessController->querryElectionCandidates($this->electionUUID);

      // TODO: darf er wählen?
      $votersdata = $electionProcessController->querryStudentData($this->spv_voter_uuid);


      //typed in birthday
      $birthday_typed = new Carbon($this->spv_birthday_year.'-'.$this->spv_birthday_month.'-'.$this->spv_birthday_day);
      //birthday in database
      $birthday_database = new Carbon($votersdata->birth_year);
      //compare the two dates

      $isallowed = $securityController->voteVerification($this->spv_voter_uuid);

      if($birthday_typed->equalTo($birthday_database) and $isallowed == true) {


        $this->state = 'vote';
      } else {
          $securityreporter = new securityreporterController($this->electionUUID);
          $securityreporter->report('birth verification failed',3, get_class(),'IP: '. \Request::getClientIp(), null);
        Self::abbort();
      }
    }

    public function abbort() {
      Self::resetData();
      $this->state = 'start';
    }

    private function resetData() {
      $this->spv_forms = null;
      $this->spv_schoolclasses = null;
      $this->spv_voters = null;
      $this->spv_birthday_day = null;
      $this->spv_birthday_month = null;
      $this->spv_birthday_year = null;
      $this->spv_candidates = null;
      $this->spv_selected_candidate_uuid = null;
      $this->spv_selected_candidate_name = null;
      $this->spv_voter_uuid = null;
    }

    public function back() {
      switch ($this->state) {
        case 'forms':
          Self::abbort();
          break;
        case 'schoolclasses':
          Self::spvOpenForms();
          break;
        case 'voters':
          //$this->state = 'schoolclasses';
            Self::abbort();
          break;
        case 'birth_verification':
          $this->state = 'voters';
          break;
        default:
          Self::abbort();
          break;
      }
    }

    public function select($candidateUUID) {
        $securityreporter = new securityreporterController($this->electionUUID);
      try {
        $securityController = new securityController($this->electionUUID);
        $terminalContoller = new terminalController($this->electionUUID);

        if ($this->election->manual_voter_activation == true AND $this->directUUID == null) {
            $isallowed = $securityController->extendedVoteVerification($this->spv_voter_uuid);
        } else {
            $isallowed = $securityController->voteVerification($this->spv_voter_uuid);
        }

        $candidatebelongsto = $securityController->verifyToElection('candidate', $candidateUUID);
        $terminalAccess = $terminalContoller->verifyTerminalAcces($this->electionUUID, $this->terminalUUID);

        if($isallowed == true and $candidatebelongsto == true and $terminalAccess == true) {
          $this->spv_selected_candidate_uuid = $candidateUUID;
          $this->spv_selected_candidate_name = Candidate::where('uuid', $candidateUUID)->firstOrFail()->name;
        } else {
            Self::resetData();
            $this->state = 'start';
        }

      } catch (\Exception $e) {
          $securityreporter->report('select a candidate failed',4, get_class(),'IP: '. \Request::getClientIp().' CandidateUUID: '. $candidateUUID, $e);
      }


    }

    public function vote() {
        $securityreporter = new securityreporterController($this->electionUUID);
      try {
        $electionProcessController = new spv($this->electionUUID);
        if($this->directUUID == null) {
            $electionProcessController->vote($this->spv_selected_candidate_uuid, $this->spv_voter_uuid, $this->terminalUUID, false);
        } else {
            $electionProcessController->vote($this->spv_selected_candidate_uuid, $this->spv_voter_uuid, $this->terminalUUID, true);
        }


        Self::resetData();
        $this->state = 'end';

      } catch (\Exception $e) {
          $securityreporter->report('livewire vote function catched',3, get_class(), null, $e);
    }

}
}
