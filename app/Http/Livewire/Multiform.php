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

  public $election;

  public $step;

  private $stepActions = [
    'submit1',
    'submit2',
    'submit3',
  ];

  protected $rules = [
    'name' => 'required|max:20',
    'description' => 'required|max:255',
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

  public function submit(){
    $this->validate();

    Election::create([
      'name' => $this->name,
      'description' => $this->description,
      'token' => 'test',
    ]);
  }

  public function render(){
    $modes = Mode::all();

        return view('livewire.multiform')->withModes($modes);
  }

/*
  public function submit1(){
    $this->validate([
      'name' => 'bail|required|max:20',
      'description' => 'required',
    ]);

    Election::create(['name' => $this->name]);

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
  */
}
