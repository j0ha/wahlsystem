<?php

namespace App\Http\Livewire;

use App\Voter;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;
use App\Http\Controllers\paperController;
use App\Mail\electionInvitation;
use Illuminate\Support\Facades\Mail;

class BackendVotersOverview extends Component
{

  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $voterUUID;
  public $name;
  public $surname;
  public $birth_year;
  public $email;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

    public function render()
    {
      $electionProcess = new electionProcessController;

        return view('livewire.backend-voters-overview', [
            'voters' => Voter::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function editVoter($voterUUID) {
      $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
      $this->voterUUID = $voterUUID;
      $this->name = $voter->name;
      $this->surname = $voter->surname;
      $this->birth_year = $voter->birth_year;
      $this->email = $voter->email;
    }
    public function deleteVoter() {
      $voter = voter::where('uuid', $this->voterUUID)->delete();
    }

    public function update() {
      $voter = Voter::where('uuid', $this->voterUUID)->firstOrFail();
      $voter->name = $this->name;
      $voter->surname = $this->surname;
      $voter->birth_year = $this->birth_year;
      $voter->email = $this->email;
      $voter->save();
    }


    public function viewVoter($voterUUID) {
      $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
      $this->voterUUID = $voterUUID;
      $this->name = $voter->name;
      $this->surname = $voter->surname;
      $this->birth_year = $voter->birth_year;
      $this->email = $voter->email;
    }

    public function sendEmail() {
      $voter = Voter::where('uuid', $this->voterUUID)->firstOrFail();
      $voter->got_email = true;
      $voter->save();
      Mail::to($voter->email)->send(new electionInvitation($voter->uuid));
    }
    public function downloadSheet() {
      redirect()->route('download.singelInvitation', ['voterUUID' => $this->voterUUID]);
    }
    public function copyDirect() {

    }

    public function downloadList() {

    }

    public function downloadPDF() {

    }

    public function print() {

    }
}
