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
      $voter = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      $this->terminalUUID = $terminalUUID;
      $this->name = $voter->name;
      $this->description = $voter->description;
      $this->kind = $voter->kind;
      $this->position = $voter->position;
      $this->start_time = $voter->start_time;
      $this->end_time = $voter->end_time;
      $this->ip_restriction = $voter->ip_restriction;
    }
    public function delete() {
      $voter = Terminal::where('uuid', $this->terminalUUID)->delete();
    }

    public function update() {
      $voter = Terminal::where('uuid', $this->terminalUUID)->firstOrFail();
      $voter->name = $this->name;
      $voter->description = $this->description;
      $voter->kind = $this->kind;
      $voter->position = $this->position;
      $voter->start_time = $this->start_time;
      $voter->end_time = $this->end_time;
      $voter->ip_restriction = $this->ip_restriction;
      $voter->save();
    }


    public function view($terminalUUID) {
      $voter = Terminal::where('uuid', $terminalUUID)->firstOrFail();
      $this->terminalUUID = $terminalUUID;
      $this->name = $voter->name;
      $this->description = $voter->description;
      $this->kind = $voter->kind;
      $this->position = $voter->position;
      $this->start_time = $voter->start_time;
      $this->end_time = $voter->end_time;
      $this->ip_restriction = $voter->ip_restriction;
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
      $voter = new Terminal;
      $voter->name = $this->name;
      $voter->uuid = Str::uuid();
      $voter->status = 'deaktiv';
      $voter->election_id = $electionProcess->getId($this->electionUUID, 'elections');
      $voter->description = $this->description;
      $voter->kind = 'browser';
      $voter->position = $this->position;
      if($this->start_time == ''){
        $voter->start_time = null;
      } else {
        $voter->start_time = $this->start_time;
      }

      if($this->end_time == '') {
        $voter->end_time = null;
      } else {
        $voter->end_time = $this->end_time;
      }
      $voter->ip_restriction = $this->ip_restriction;
      $voter->save();
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
