<?php

namespace App\Http\Livewire;

use App\Voter;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;

class VotersTable extends Component
{
  use WithPagination;

  public $perPage = 10;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $updateMode;

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
    
      return view('livewire.voters-table', [
          'voters' => Voter::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
              ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
              ->simplePaginate($this->perPage),
      ]);
  }

  public function editVoter($voterUUID) {
    $this->updateMode = true;
    $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
    $this->voterUUID = $voterUUID;
    $this->name = $voter->name;
    $this->surname = $voter->surname;
    $this->birth_year = $voter->birth_year;
    $this->email = $voter->email;
  }
  public function deleteVoter($voterUUID) {
    $voter = voter::where('uuid', $voterUUID)->delete();
  }

  public function update() {
    $voter = Voter::where('uuid', $this->voterUUID)->firstOrFail();
    $voter->name = $this->name;
    $voter->surname = $this->surname;
    $voter->birth_year = $this->birth_year;
    $voter->email = $this->email;
    $voter->save();
    $this->updateMode = false;
  }

  public function cancel() {
    $this->updateMode = false;
  }
}
