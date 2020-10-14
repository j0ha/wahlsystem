<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mode;

class ElectionCreater extends Controller
{


  public function __construct()
  {
    
  }


  public function index()
  {
    $modes = Mode::all();

    return view('createElection')->withModes($modes);
  }
}
