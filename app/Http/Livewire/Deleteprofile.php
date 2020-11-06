<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Deleteprofile extends Component
{
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

        return redirect()->route('homeE', ['electionUUID' => $uuid]);
    }

    public function render()
    {
      $user = User::find(Auth::user()->id);
        return view('livewire.deleteprofile')->withUser($user);
    }
}
