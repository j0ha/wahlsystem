<?php

namespace App\Http\Controllers;

use App\Voter;
use Illuminate\Http\Request;

class voteractivatorController extends Controller
{
    private $electionUUID;
    private $securityController;
    private $securityreporter;
    private $terminalcontroller;

    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityController = new securityController($this->electionUUID);
        $this->securityreporter = new securityreporterController($this->electionUUID);
        $this->terminalcontroller = new terminalController($this->electionUUID);
    }

    public function activateVoter($voterUUID) {
        $voterToElection = $this->securityController->verifyToElection('voter', $voterUUID, $this->electionUUID);
        $voterVerification = $this->securityController->voteVerification($voterUUID);

        if($voterToElection == true and $voterVerification == true) {
            Self::activateAgent($voterUUID);
        } else {
            $this->securityreporter->report('voter activation failed. One statement does not fit to the election', 4, get_class(), 'it is possible that someone tries to break in to the election', null);
        }

    }

    public function returnVoter($directLink) {
        try {
        $contents = explode('/', $directLink);

        $electionUUID = $contents[5];
        $terminalUUID = $contents[6];
        $directUUID = $contents[7];

        $terminalToElection = $this->terminalcontroller->verifyTruthiness($terminalUUID);
        $voterToElection = $this->securityController->verifyToElection('voter_direct', $directUUID);
        $electionUUIDtoElectionUUID = Self::electionUUIDisElectionUUID($electionUUID);

        $voter = Voter::where('direct_uuid', $directUUID)->firstOrFail();

        if($voterToElection == true and $electionUUIDtoElectionUUID == true and $terminalToElection == true) {
            return $voter;
        } else {
            return false;
        }

        } catch(\Exception $e) {
            return false;
        }
    }

    private function electionUUIDisElectionUUID($electionUUID) {

        if($electionUUID == $this->electionUUID) {
            return true;
        } else {
            return false;
        }
    }

    private function activateAgent($voterUUID) {
        try {
            $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
            $voter->activated = true;
            $voter->save();
        } catch(\Exception $e) {
            $this->securityreporter->report('voter activation agent failed', 3, get_class(), null, null);
        }
    }
}