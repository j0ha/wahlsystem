<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;

class backendController extends Controller
{
    public function home($electionUUID){
      $elections = Election::all();
      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->withElections($elections);
    }
    public function stats($electionUUID){
      $elections = Election::all();

      return view('backendviews.Stats', ['electionUUID' => $electionUUID])->withElections($elections);
    }
}
