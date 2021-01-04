<?php

namespace App\Http\Livewire;

use App\Schoolclass;
use App\Form;
use App\Voter;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;
use Illuminate\Support\Str;

class BackendSchoolclassesOverview extends Component
{
  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $schoolclassUUID;
  public $name;
  public $form_id;
  public $forms;

  public $electionUUID;

    protected $rules = [
        'name' => 'required|max:255',
        'form_id' => 'required|numeric',
    ];

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
    $electionProcess = new electionProcessController($this->electionUUID);
    $this->forms = Form::where('election_id', $electionProcess->getId($electionUUID, 'elections'))->get();
  }

    public function render()
    {
      $electionProcess = new electionProcessController($this->electionUUID);

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
      $schoolclass = Schoolclass::where('uuid', $schoolclassUUID)->firstOrFail();
      $voters = Voter::where('schoolclass_id', $schoolclass->id)->count();
      if($voters != 0) {
          session()->flash('error', 'Schoolclass can not be deleted with assigned students!');
      } else {
          $schoolclass->delete();
      }
    }

    public function update() {
      $schoolclass = Schoolclass::where('uuid', $this->schoolclassUUID)->firstOrFail();
      $schoolclass->name = $this->name;
      $schoolclass->save();
    }

    public function downloadList() {

    }

    public function downloadPDF() {
        redirect()->route('download.schoolclasses', ['electionUUID'=>$this->electionUUID]);
    }

    public function print() {

    }

    public function create(){


      $this->schoolclassUUID = '';
      $this->name = '';
      $this->form_id = null;

    }

    public function createSave(){
      $this->validate();
      $schoolclass = new Schoolclass;
      $electionProcess = new electionProcessController($this->electionUUID);
      $schoolclass->name = $this->name;
      $schoolclass->uuid = Str::uuid();
      $schoolclass->form_id = $this->form_id;
      $schoolclass->election_id = $electionProcess->getId($this->electionUUID, 'elections');
      $schoolclass->save();
    }
}
