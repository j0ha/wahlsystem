<?php

namespace App\Http\Livewire;

use App\Election;
use App\Http\Controllers\electionProcessController;
use App\Http\Controllers\securityController;
use App\Http\Controllers\voteractivatorController;
use App\Voter;
use Livewire\Component;

class BackendVoteractivator extends Component
{

    public $search_url;
    public $voter;
    public $state;
    public $stat_voter;
    public $stat_active_voters;
    public $stat_outcome;
    public $election;
    public $electionUUID;

    public function render()
    {
        $electionProcess = new electionProcessController($this->electionUUID);
        $this->stat_voter = Voter::where('election_id',  $electionProcess->getId($this->electionUUID, 'elections'))->count();
        $this->stat_active_voters = Voter::where([
            ['election_id', '=', $electionProcess->getId($this->electionUUID, 'elections')],
            ['activated', '=', true],
        ])->count();
        $this->stat_outcome = Voter::where('election_id',  $electionProcess->getId($this->electionUUID, 'elections'))->where(function ($query){
            $query->where('voted_via_terminal', 1)->orWhere('voted_via_email', 1)->count();
        })->count();
        $this->election = Election::where('uuid', $this->electionUUID)->firstOrFail();
        return view('livewire.backend-voteractivator');
    }

    public function mount($electionUUID) {
        $this->electionUUID = $electionUUID;
    }

    public function search(){

        $voteractivatorController = new voteractivatorController($this->electionUUID);
        $securitycontroller = new securityController($this->electionUUID);

        $voter = $voteractivatorController->returnVoter($this->search_url);

        if($voter != false) {
            if($securitycontroller->voteVerification($voter->uuid) == true AND $voter->activated == true) {
                $this->voter = $voter;
                $this->state = 'activated';
            }  elseif ($securitycontroller->voteVerification($voter->uuid) == false){
                $this->voter = $voter;
                $this->state = 'voted';
            } elseif($securitycontroller->voteVerification($voter->uuid) == true) {
                $this->voter = $voter;
                $this->state = 'allow';
            } else {
                $this->state = 'error';
            }

        } else {
            $this->state = 'error';
        }
    }
    public function tada() {
        dd("es geht");
    }

    public function aa() {
            $voteractivatorController = new voteractivatorController($this->electionUUID);
            $voteractivatorController->activateVoter($this->voter->uuid);
            $this->search_url = '';
            $this->state = 'error';
    }

    public function hello() {
        $voteractivatorController = new voteractivatorController($this->electionUUID);
        $voteractivatorController->activateVoter($this->voter->uuid);
        $this->search_url = '';
        $this->state = 'error';
    }
}
