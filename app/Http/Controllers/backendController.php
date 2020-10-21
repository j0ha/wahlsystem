<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use Illuminate\Database\Eloquent\Model;

class backendController extends Controller
{
    public function home($electionUUID){
      $elections = Election::all();
      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->withElections($elections);
    }
    public function stats($electionUUID){
      $elections = Election::all();

      $selectedElection = Election::where('UUID', $electionUUID);

      return view('backendviews.Stats', ['electionUUID' => $electionUUID])->withElections($elections);
    }
}
