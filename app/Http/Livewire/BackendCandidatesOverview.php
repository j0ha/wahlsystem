<?php

namespace App\Http\Livewire;

use App\Candidate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;

class BackendCandidatesOverview extends Component
{
  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $candidateUUID;
  public $name;
  public $description;
  public $type;
  public $level;
  public $image;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

    public function render()
    {
      $electionProcess = new electionProcessController($this->electionUUID);

        return view('livewire.backend-candidates-overview', [
            'candidates' => Candidate::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function editCandidate($candidateUUID) {
      $candidate = Candidate::where('uuid', $candidateUUID)->firstOrFail();
      $this->candidateUUID = $candidateUUID;
      $this->name = $candidate->name;
      $this->description = $candidate->description;
      $this->type = $candidate->type;
      $this->level = $candidate->level;
      $this->image = $candidate->image;
    }
    public function deleteCandidate($candidateUUID) {
      $candidate = Candidate::where('uuid', $candidateUUID)->delete();
    }

    public function update() {
      $candidate = Candidate::where('uuid', $this->candidateUUID)->firstOrFail();
      $candidate->name = $this->name;
      $candidate->description = $this->description;
      $candidate->type = $this->type;
      $candidate->level = $this->level;
      $candidate->image = $this->image;
      $candidate->save();
    }

    public function downloadList() {

    }

    public function downloadPDF() {

    }

    public function print() {

    }
}
