<?php

namespace App\Http\Livewire;

use Livewire\Component;

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

  public function decrease(){
    $this->step = $step--;
  }

  public function render(){
        return view('livewire.multiform');
  }

  public function submit(){
    $action = $this->stepActions[$this->step];
    $this->$action();
  }

  public function submit1(){
    // $this->validate([
    //   '' => '',
    // ]);

    $this->step++;
  }

  public function submit2(){
    // $this->validate([
    //   '' => '',
    // ]);
    $this->step++;
  }

  public function submit3(){
    // $this->validate([
    //   '' => '',
    // ]);
    $this->step++;
  }
}
