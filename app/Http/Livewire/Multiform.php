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

  private $stepActions = [
    'submit1',
    'submit2',
    'submit3',
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

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

  public function submit(){
    $action = $this->stepActions[$this->step];
    $this->$action();
  }

  public function submit1(){
    $this->validate([
      'name' => 'bail|required|max:20',
      'description' => 'required',
    ]);

    




    $this->step++;
  }

  public function submit2(){
    // $this->validate([
    //   '' => '',
    // ]);
    $this->step++;
    return view('welcome');
  }

  public function submit3(){
    // $this->validate([
    //   '' => '',
    // ]);
    return view('welcome');
  }
}
