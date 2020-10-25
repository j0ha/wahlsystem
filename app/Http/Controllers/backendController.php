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
      $selectedE = Election::where('uuid', $electionUUID)->get();
      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->withElections($elections)->with(compact('selectedE'));
    }
    public function stats($electionUUID){
      $elections = Election::all();



      return view('backendviews.Stats',['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function voter($electionUUID){
      $elections = Election::all();

      return view('backendviews.VotersTable', ['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function voteradd($electionUUID){
      $elections = Election::all();

      return view('backendviews.AddSingleV', ['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function bulkaddV($electionUUID){
      $elections = Election::all();

      return view('backendviews.AddMultipleV', ['electionUUID' => $electionUUID])->withElections($elections);
    }
    // !!! End - ELECTION BACKEND !!!

    // !!! Profile BACKEND !!!
    public function data(){
      return view('backendviews.profileData');
    }
    // !!! End-Profile BACKEND !!!
}
