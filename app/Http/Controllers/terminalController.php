<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use App\Terminal;
use Carbon\Carbon;

class terminalController extends Controller
{
    public function index($electionUUID, $terminalUUID) {
      if(Self::verifyTerminalAcces($electionUUID, $terminalUUID) == true) {
        return view('vote.vote')->with('terminalUUID', $terminalUUID)->with('electionUUID', $electionUUID);
      } else {
        return abort(404);
      }
    }

  //Function to verify if the controller and the termial fit together
    private function verifyTruthiness($electionUUID, $terminalUUID)
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
    private function checkActiveTime($electionUUID, $terminalUUID) {
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if(($terminal->start_time <= Carbon::now() && $terminal->end_time >= Carbon::now()) OR ($terminal->start_time == null && $terminal->end_time ==null)) {
          return true;

        } else {
          return false;

        }

      } catch (\Exception $e) {
        return false;
      }

    }
    //Function to check if the Clients IP is allowed to visit the termial
    private function checkUserIp($electionUUID, $terminalUUID) {
      $clientIp = \Request::getClientIp();
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->ip_restriction == $clientIp OR $terminal->ip_restriction == null) {

          return true;

        } else {

          return false;

        }

      } catch (\Exception $e) {
        return false;
      }
    }

    //Function to check the terminal status
    private function checkTerminalStatus($electionUUID, $terminalUUID) {
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->status == "active") {

          return true;

        } else {

          return false;

        }

      } catch (\Exception $e) {
        return false;
      }
    }

    //Function to check the terminal status
    private function checkElectionStatus($electionUUID, $terminalUUID) {
      try {
        $election = Election::where('uuid', $electionUUID)->firstOrFail();

        if($election->status == "active") {

          return true;

        } else {

          return false;

        }

      } catch (\Exception $e) {

        return false;
      }
    }

    //Function to verify the acces to the vote terminal
    public function verifyTerminalAcces($electionUUID, $terminalUUID) {

      $ces = Self::checkElectionStatus($electionUUID, $terminalUUID);
      $cts = Self::checkTerminalStatus($electionUUID, $terminalUUID);
      $cuip = Self::checkUserIp($electionUUID, $terminalUUID);
      $cat = Self::checkActiveTime($electionUUID, $terminalUUID);
      $vt = Self::verifyTruthiness($electionUUID, $terminalUUID);


      if($ces == true && $cts == true && $cuip == true && $cat == true && $vt == true) {
        return true;
      } else {
        return false;
      }
    }

    public function hit($terminalUUID){
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        $terminal->hits = $terminal->hits + 1;
        $terminal->update();
      } catch (\Exception $e) {
        // TODO: error reporter
      }

    }
}
