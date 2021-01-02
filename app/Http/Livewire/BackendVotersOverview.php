<?php

namespace App\Http\Livewire;

use App\Http\Controllers\emailController;
use App\Terminal;
use App\Voter;
use Illuminate\Support\Str;
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
  public $terminals;
  public $terminal_sel;
  public $hasDirectly;

  public $electionUUID;

  public function mount($electionUUID) {
    $this->electionUUID = $electionUUID;
  }

    public function render()
    {
      $electionProcess = new electionProcessController($this->electionUUID);

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
        $electionProcess = new electionProcessController($this->electionUUID);
            $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
            $this->terminals = Terminal::where([
                ['election_id', '=', $electionProcess->getId($this->electionUUID, 'elections')],
                ['kind', '=', config('terminalkinds.email.short')],
            ])->get();
            $this->voterUUID = $voterUUID;
            $this->name = $voter->name;
            $this->surname = $voter->surname;
            $this->birth_year = $voter->birth_year;
            $this->email = $voter->email;
            if($voter->direct_uuid == null) {
                $this->hasDirectly = false;
            } else {
                $this->hasDirectly = true;
            }


    }

    public function sendEmail() {
      $voter = Voter::where('uuid', $this->voterUUID)->firstOrFail();
      $emailController = new emailController($this->electionUUID);
      $emailController->sendSingelInvation($voter->uuid, $this->terminal_sel);
    }
    public function downloadSheet() {
      redirect()->route('download.singelInvitation', ['voterUUID' => $this->voterUUID, 'electionUUID'=>$this->electionUUID]);
    }

    public function direct() {
        $voter = Voter::where('uuid', $this->voterUUID)->firstOrFail();
        if($voter->direct_uuid == null) {
            $voter->direct_uuid = Str::uuid();
            $voter->update();
        }
    }

    public function downloadPDF() {
        redirect()->route('download.voters', ['electionUUID'=>$this->electionUUID]);
    }
}
