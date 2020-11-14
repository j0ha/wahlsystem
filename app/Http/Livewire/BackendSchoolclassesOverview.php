<?php

namespace App\Http\Livewire;

use App\Schoolclass;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;

class BackendSchoolclassesOverview extends Component
{
  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $schoolclassUUID;
  public $name;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

    public function render()
    {
      $electionProcess = new electionProcessController;

        return view('livewire.backend-schoolclasses-overview', [
            'schoolclasses' => Schoolclass::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function edit($schoolclassUUID) {
      $schoolclass = Schoolclass::where('uuid', $schoolclassUUID)->firstOrFail();
      $this->schoolclassUUID = $schoolclassUUID;
      $this->name = $schoolclass->name;
    }
    public function delete($schoolclassUUID) {
      $schoolclass = Schoolclass::where('uuid', $schoolclassUUID)->delete();
    }

    public function update() {
      $schoolclass = Schoolclass::where('uuid', $this->schoolclassUUID)->firstOrFail();
      $schoolclass->name = $this->name;
      $schoolclass->save();
    }

    public function downloadList() {

    }

    public function downloadPDF() {

    }

    public function print() {

    }
}
