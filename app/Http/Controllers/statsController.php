<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terminal;
use App\Voter;
use App\Form;
use App\Schoolclass;
use App\Http\Controllers\electionProcessController;
use App\Http\Controllers\electiontypes\spv;

class statsController extends Controller
{
    private $electionUUID;

    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
    }

    public function terminalUsage() {
      $electionProcessController = new electionProcessController($this->electionUUID);
      $terminals = Terminal::where('election_id', $electionProcessController->getId($this->electionUUID, 'elections'))->get();
      // $electionProcessController->getId($electionUUID, 'elections')
      $terminalStat = array();
      $terminalStat_sumHits = 0;

      foreach ($terminals as $terminal) {
        $terminalStat_sumHits = $terminalStat_sumHits + $terminal->hits;
      }

      foreach($terminals as $terminal) {
          if($terminalStat_sumHits != 0) {
              $terminalStat[$terminal->name] = array(round($terminal->hits/$terminalStat_sumHits*100, 2), $terminal->name);
          } else {
              $terminalStat[$terminal->name] = array(0, $terminal->name);
          }




      }
      return $terminalStat;
    }

    public function terminals() {
      $electionProcessController = new electionProcessController($this->electionUUID);
      $terminals = Terminal::where('election_id', $electionProcessController->getId($this->electionUUID, 'elections'))->get();
      return $terminals;
    }

    public function schoolclassesSpread() {
      $spv = new spv($this->electionUUID);
      $schoolclasses = Schoolclass::where('election_id', $spv->getId($this->electionUUID, 'elections'))->get();
      $schoolclassspreadStat = array();

      foreach ($schoolclasses as $schoolclass) {
        $schoolclassvoterscount = Voter::where('schoolclass_id', $schoolclass->id)->count();
        $schoolclassspreadStat[] = array($schoolclass->name, $schoolclassvoterscount);
      }
      return $schoolclassspreadStat;
    }

    public function formVoterSpread() {
      $electionProcessController = new electionProcessController($this->electionUUID);
      $votersCount = Voter::where('election_id', $electionProcessController->getId($this->electionUUID, 'elections'))->count();
      $forms = Form::where('election_id', $electionProcessController->getId($this->electionUUID, 'elections'))->get();

      $formspreadStat = array();


      foreach($forms as $form) {
        $votersFormCount = Voter::where('form_id', $form->id)->count();

        if($votersFormCount > 0 AND $votersCount > 0) {
            $formspreadStat[] = array($form->name, round($votersFormCount/$votersCount*100, 2));
        } else {
            $formspreadStat[] = array($form->name, 0);
        }


      }
      return $formspreadStat;
    }

    public function schoolclassesVoteTurnout() {
      $spv = new spv($this->electionUUID);
      $schoolclasses = Schoolclass::where('election_id', $spv->getId($this->electionUUID, 'elections'))->get();
      $schoolclassTurnoutStat = array();

      foreach ($schoolclasses as $schoolclass) {

        $voterVotedCount = 0;
        $voterCount = 0;
        $voterCount = Voter::where('schoolclass_id', $schoolclass->id)->count();
        $voterVotedCount = Voter::where('schoolclass_id', $schoolclass->id)->where('voted_via_email', true)->count() + Voter::where('schoolclass_id', $schoolclass->id)->Where('voted_via_terminal', true)->count();

        if($voterVotedCount > 0 and $voterCount > 0) {
          $schoolclassTurnoutStat[] = array($schoolclass->name, round($voterVotedCount/$voterCount*100, 2));
        } else {
          $schoolclassTurnoutStat[] = array($schoolclass->name, 0);
        }

      }
      return $schoolclassTurnoutStat;
    }
}
