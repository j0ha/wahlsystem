<?php

namespace App\Http\Livewire;

use App\Form;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;

class BackendSchoolgradesOverview extends Component
{
  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $schoolgradeUUID;
  public $name;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

    public function render()
    {
      $electionProcess = new electionProcessController($this->electionUUID);

        return view('livewire.backend-schoolgrades-overview', [
            'schoolgrades' => Form::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function edit($schoolgradeUUID) {
      $schoolgrade = Form::where('uuid', $schoolgradeUUID)->firstOrFail();
      $this->schoolgradeUUID = $schoolgradeUUID;
      $this->name = $schoolgrade->name;
    }
    public function delete($schoolgradeUUID) {
      $schoolgrade = Form::where('uuid', $schoolgradeUUID)->delete();
    }

    public function update() {
      $schoolgrade = Form::where('uuid', $this->schoolgradeUUID)->firstOrFail();
      $schoolgrade->name = $this->name;
      $schoolgrade->save();
    }

    public function downloadList() {

    }

    public function downloadPDF() {

    }

    public function print() {

    }

    public function create(){
      $this->schoolgradeUUID = '';
      $this->name = '';

    }

    public function createSave(){
      $schoolclass = new Form;
      $electionProcess = new electionProcessController($this->electionUUID);
      $schoolclass->name = $this->name;
      $schoolclass->uuid = Str::uuid();
      $schoolclass->election_id = $electionProcess->getId($this->electionUUID, 'elections');
      $schoolclass->save();
    }
}
