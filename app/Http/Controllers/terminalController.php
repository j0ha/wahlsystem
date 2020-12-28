<?php

namespace App\Http\Controllers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use App\Election;
use App\Terminal;
use Carbon\Carbon;

class terminalController extends Controller
{
    private $electionUUID;
    private $securityreporter;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityreporter = new securityreporterController($this->electionUUID);
    }

    public function index($terminalUUID) {
      if(Self::verifyTerminalAcces($this->electionUUID, $terminalUUID) == true) {
        return view('vote.vote')->with('terminalUUID', $terminalUUID)->with('electionUUID', $this->electionUUID);
      } else {
        return abort(404);
      }
    }

  //Function to verify if the controller and the termial fit together
    public function verifyTruthiness($terminalUUID)
    {
      $election = null;
      $terminal = null;

      try {
        $election = Election::where('uuid', $this->electionUUID)->firstOrFail();
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      } catch (\Exception $e) {
          $this->securityreporter->report('ElectionUUID or TerminalUUID not found',3, get_class(),'IP: '. \Request::getClientIp(), null);
        return false;
      }

      if($terminal->election_id == $election->id) {
        return true;
      } else {
          $this->securityreporter->report('ElectionUUID does not fit TerminalUUID',3, get_class(),'IP: '. \Request::getClientIp(), null);
        return false;
      }
    }
    //Function to check if the terminal is within the time slot for operation
    private function checkActiveTime($terminalUUID) {
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if(($terminal->start_time <= Carbon::now() && $terminal->end_time >= Carbon::now()) OR ($terminal->start_time == null && $terminal->end_time ==null)) {
          return true;

        } else {
            $this->securityreporter->report('Tried to access Terminal at wrong access time',5, get_class(),null, null);
          return false;
        }

      } catch (\Exception $e) {
        return false;
      }

    }
    //Function to check if the Clients IP is allowed to visit the termial
    private function checkUserIp($terminalUUID) {
      $clientIp = \Request::getClientIp();
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->ip_restriction == $clientIp OR $terminal->ip_restriction == null) {

          return true;

        } else {
            $this->securityreporter->report('Tried to access Terminal with wrong IP',5, get_class(),null, null);
            return false;

        }

      } catch (\Exception $e) {
        return false;
      }
    }

    //Function to check the terminal status
    private function checkTerminalStatus($terminalUUID) {
      try {
        $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

        if($terminal->status == true) {

          return true;

        } else {
            $this->securityreporter->report('Tried to access Terminal at wrong status',5, get_class(), null, null);
            return false;

        }

      } catch (\Exception $e) {
        return false;
      }
    }

    //Function to check the terminal status
    private function checkElectionStatus() {
      try {
        $election = Election::where('uuid', $this->electionUUID)->firstOrFail();

        if($election->status == "active") {

          return true;

        } else {
            $this->securityreporter->report('Tried to access Election at wrong status',5, get_class(), null, null);
          return false;

        }

      } catch (\Exception $e) {

        return false;
      }
    }

    //Function to verify the acces to the vote terminal
    public function verifyTerminalAcces($electionUUID, $terminalUUID) {

      $ces = Self::checkElectionStatus();
      $cts = Self::checkTerminalStatus($terminalUUID);
      $cuip = Self::checkUserIp($terminalUUID);
      $cat = Self::checkActiveTime($terminalUUID);
      $vt = Self::verifyTruthiness($terminalUUID);


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
      }

    }
}
