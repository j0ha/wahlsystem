<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;

class backendController extends Controller
{
    public function home(){
      $elections = Election::all();
      return view('backendviews.BasicInfos')->withElections($elections);
    }
}
