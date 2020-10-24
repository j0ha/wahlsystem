<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use Illuminate\Database\Eloquent\Model;

class backendController extends Controller
{
    // !!! ELECTION BACKEND !!!
    public function home($electionUUID){
      $elections = Election::all();
      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->withElections($elections);
    }
    public function stats($electionUUID){
      $elections = Election::all();

      $selectedE = Election::where('uuid', $electionUUID)->first();



      return view('backendviews.Stats', compact($selectedE), ['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function voter($electionUUID){
      $elections = Election::all();

      return view('backendviews.VotersTable', ['electionUUID' => $electionUUID])->withElections($elections);
    }


    // !!! Profile BACKEND !!!
    public function data(){
      return view('backendviews.profileData');
    }
}
