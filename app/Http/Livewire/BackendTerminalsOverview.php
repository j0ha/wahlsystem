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
  public $status;
  public $end_time;
  public $ip_restriction;
  public $url;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

  protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        'position' => 'required|max:255',
        'start_time' => '',
        'end_time' => '',
        'ip_restriction' => 'ipv4',
    ];


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
      $this->status = $terminal->status;
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
      $this->validate();
      $terminal = Terminal::where('uuid', $this->terminalUUID)->firstOrFail();
      $terminal->name = $this->name;
      $terminal->description = $this->description;
      $terminal->kind = $this->kind;
      $terminal->status = $this->status;
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
      $this->status = $terminal->status;
      $this->position = $terminal->position;
      $this->start_time = $terminal->start_time;
      $this->end_time = $terminal->end_time;
      $this->ip_restriction = $terminal->ip_restriction;
      $this->url = route('vote', ['electionUUID' => $this->electionUUID, 'terminalUUID' => $this->terminalUUID]);
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
      $this->validate();
      $electionProcess = new electionProcessController;
      $terminal = new Terminal;
      $terminal->name = $this->name;
      $terminal->uuid = Str::uuid();
      $terminal->status = false;
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
        dd(config('terminalkinds'));
    }

    public function downloadPDF() {

    }

    public function print() {

    }
}
