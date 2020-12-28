<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\electionProcessController;
use App\Mode;
use App\Election;
use App\Voter;


class createController extends Controller
{


    public function index(){
      return view('electionCreation');
    }


}
