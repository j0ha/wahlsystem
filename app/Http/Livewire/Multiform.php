<?php

namespace App\Http\Livewire;

use App\Candidate;
use Livewire\Component;
use App\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Multiform extends Component
{

  public $name;
  public $description;
  public $abstention;
  public $stats;
  public $mode;
  public $manualVoter;

  public $step;

  protected $rules = [
    'name' => 'required|max:100',
    'description' => 'required|max:100',
    'mode' => 'required',

  ];

  public function mount(){

    $this->step = 0;
  }

  public function increaseStep(){
    $this->step++;
  }

  public function decreaseStep(){
    $this->step--;
  }

  public function updated($electionName){
    $this->validateOnly($electionName,[
      'name' => 'required|max:100',
      'description' => 'required|max:100',
    ]);

  }

  public function submit(){


        $this->validate();

        $uuid=Str::uuid();

        $permission = Permission::create(['name' => $uuid]);
        $user = Auth::user();
        $user->givePermissionTo($permission);

        $e = new Election;

        $e->name = $this->name;
        $e->description = $this->description;
        if(isset($this->abstention)){
            $e->abstention = 1;
        } else {
            $e->abstention = 0;
        }

        if(isset($this->stats)){
            $e->statistics = 1;
        } else {
            $e->statistics = 0;
        }

      if(isset($this->manualVoter)){
          $e->manual_voter_activation = 1;
      } else {
          $e->manual_voter_activation = 0;
      }
        $e->status = "waiting";
        $e->uuid = $uuid;
        $e->type = $this->mode;
        $e->permission_id = $permission->id;
        $e->save();

      if(isset($this->abstention)){
          $c = new Candidate();
          $c->name = 'Abstention';
          $c->description = '';
          $c->type = 'spt';
          $c->election_id = $e->id;
          $c->uuid = Str::uuid();
          $c->level = 1;
          $c->deletable = false;
          $c->save();
      }


      return redirect()->route('election.Dashboard', ['electionUUID' => $uuid]);
  }

  public function render(){
    $modes = config('electionmodes');

        return view('livewire.multiform')->withModes($modes);
  }

}
