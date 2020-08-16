<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use App\Terminal;
use Carbon\Carbon;

class terminalController extends Controller
{

  //Function to verify if the controller and the termial fit together
    public function verifyTruthiness($electionUUID, $terminalUUID)
    {
      $election = null;
      $terminal = null;

      try {
        $election = Election::where('uuid', $electionUUID)->firstOrFail();
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      } catch (\Exception $e) {
        return false;
      }

      if($terminal->election_id == $election->id) {
        return true;
      } else {
        return false;
      }
    }
    //Function to check if the terminal is within the time slot for operation
    public function checkActiveTime($electionUUID, $terminalUUID) {
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->start_time <= Carbon::now() && $terminal->end_time >= Carbon::now()) {
          return true;

        } else {
          return false;

        }

      } catch (\Exception $e) {
        return false;
      }

    }
    //Function to check if the Clients IP is allowed to visit the termial
    public function checkUserIp($electionUUID, $terminalUUID) {
      $clientIp = \Request::getClientIp();
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->ip_restriction == $clientIp) {

          return true;

        } else {

          return false;

        }

      } catch (\Exception $e) {
        return false;
      }
    }
}
