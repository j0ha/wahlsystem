<?php

namespace App\Http\Livewire;

use App\Terminal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\electionProcessController;
use Illuminate\Support\Str;

class BackendTerminalsOverview extends Component
{
  use WithPagination;

  public $perPage = 20;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public $terminalUUID;
  public $name;
  public $description;
  public $kind;
  public $position;
  public $start_time;
  public $end_time;
  public $ip_restriction;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }


    public function render()
    {
      $electionProcess = new electionProcessController;
        return view('livewire.backend-terminals-overview', [
            'terminals' => Terminal::search($this->search, $electionProcess->getId($this->electionUUID, 'elections'))
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function edit($terminalUUID) {
      $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      $this->terminalUUID = $terminalUUID;
      $this->name = $terminal->name;
      $this->description = $terminal->description;
      $this->kind = $terminal->kind;
      $this->position = $terminal->position;
      $this->start_time = $terminal->start_time;
      $this->end_time = $terminal->end_time;
      $this->ip_restriction = $terminal->ip_restriction;
    }
    public function delete() {
      $terminal = Terminal::where('uuid', $this->terminalUUID)->delete();
    }

    public function update() {
      $terminal = Terminal::where('uuid', $this->terminalUUID)->firstOrFail();
      $terminal->name = $this->name;
      $terminal->description = $this->description;
      $terminal->kind = $this->kind;
      $terminal->position = $this->position;
      $terminal->start_time = $this->start_time;
      $terminal->end_time = $this->end_time;
      $terminal->ip_restriction = $this->ip_restriction;
      $terminal->save();
    }


    public function view($terminalUUID) {
      $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      $this->terminalUUID = $terminalUUID;
      $this->name = $terminal->name;
      $this->description = $terminal->description;
      $this->kind = $terminal->kind;
      $this->position = $terminal->position;
      $this->start_time = $terminal->start_time;
      $this->end_time = $terminal->end_time;
      $this->ip_restriction = $terminal->ip_restriction;
    }

    public function create(){
      $this->terminalUUID = '';
      $this->name = '';
      $this->description = '';
      $this->kind = '';
      $this->position = '';
      $this->start_time = '';
      $this->end_time = '';
      $this->ip_restriction = '';
    }

    public function createSave(){
      $electionProcess = new electionProcessController;
      $terminal = new Terminal;
      $terminal->name = $this->name;
      $terminal->uuid = Str::uuid();
      $terminal->status = 'deaktiv';
      $terminal->election_id = $electionProcess->getId($this->electionUUID, 'elections');
      $terminal->description = $this->description;
      $terminal->kind = 'browser';
      $terminal->position = $this->position;
      if($this->start_time == ''){
        $terminal->start_time = null;
      } else {
        $terminal->start_time = $this->start_time;
      }

      if($this->end_time == '') {
        $terminal->end_time = null;
      } else {
        $terminal->end_time = $this->end_time;
      }
      $terminal->ip_restriction = $this->ip_restriction;
      $terminal->save();
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
