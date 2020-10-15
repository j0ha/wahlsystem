<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mode;
use App\Election;
use Illuminate\Http\Request;
use 


class Multiform extends Component
{

  public $name;
  public $description;
  public $mode;

  public $step;

  public function mount(){
    $this->step = 0;
  }

  public function increaseStep(){
    $this->step++;
  }

  public function decreaseStep(){
    $this->step--;
  }

  public function submit(){

      $e = new Election;

      $e->name = $this->name;
      $e->description = $this->description;
      $e->abstention = 1;
      $e->status = "active";
      $e->uuid = $uuid=Str::uuid();
      $e->type = $this->mode;
      $e->save();

      return "erfolg";
  }

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

}
