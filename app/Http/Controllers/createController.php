<?php

namespace App\Http\Controllers;

use App\Mode;
use Illuminate\Http\Request;

class createController extends Controller
{



    public function index(){
      return view('electionCreation');
    }
}
