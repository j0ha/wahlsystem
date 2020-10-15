<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mode;
use App\Election;
use Illuminate\Http\Request;

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
  }

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

}
