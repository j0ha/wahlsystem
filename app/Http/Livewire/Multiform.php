<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mode;
use App\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


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

        $e = new Election;

        $e->name = $this->name;
        $e->description = $this->description;
        $e->abstention = 1;
        $e->status = "active";
        $e->uuid = $uuid=Str::uuid();
        $e->type = $this->mode;
        $e->save();


      return redirect()->route('homeE', ['electionUUID' => $uuid]);
  }

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

}
