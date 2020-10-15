<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mode;
use App\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class Multiform extends Component
{

  public $name;
  public $description;
  public $mode;

  public $step;

  public function mount($mod){
    $this->mode = $mod;
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

      //$this->step++;

      return "erfolg";
  }

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

}
