<?php

namespace App\Http\Livewire;

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
  public $mode;

  public $step;

  protected $rules = [
    'name' => 'required|max:100|alpha_dash',
    'description' => 'required|max:100',
  ];

  public function mount(){

    $this->step = 0;
  }

  public function increaseStep(){
    $this->validate();
    $this->step++;
  }

  public function decreaseStep(){
    $this->step--;
  }

  public function updated($electionName){
    $this->validateOnly($electionName);
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
        $e->abstention = 1;
        $e->status = "active";
        $e->uuid = $uuid;
        $e->type = $this->mode;
        $e->permission_id = $permission->id;
        $e->save();





      return redirect()->route('homeE', ['electionUUID' => $uuid]);
  }

  public function render(){
    $modes = config('electionmodes');

        return view('livewire.multiform')->withModes($modes);
  }

}
