<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terminal;
use App\Http\Controllers\electionProcessController;

class statsController extends Controller
{
    public function terminalUsage($electionUUID) {
      $electionProcessController = new electionProcessController;
      $terminals = Terminal::where('election_id', $electionProcessController->getId($electionUUID, 'elections'))->get();
      // $electionProcessController->getId($electionUUID, 'elections')
      $terminalStat = array();
      $terminalStat_sumHits = 0;

      foreach ($terminals as $terminal) {
        $terminalStat_sumHits = $terminalStat_sumHits + $terminal->hits;
      }

      foreach($terminals as $terminal) {
        $terminalStat[$terminal->name] = array(round($terminal->hits/$terminalStat_sumHits*100, 2), $terminal->name);

      }
      return $terminalStat;
    }

    public function terminals($electionUUID) {
      $electionProcessController = new electionProcessController;
      $terminals = Terminal::where('election_id', $electionProcessController->getId($electionUUID, 'elections'))->get();
      return $terminals;
    }
}
