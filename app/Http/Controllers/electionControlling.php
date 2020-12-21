<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;

class electionControlling extends Controller
{
    public function activate(Request $request){

        $election = Election::where('uuid', $request->eUUID)->update(['status' => 'live']);


        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function activateWithTime(Request $request){

        $election = Election::where('uuid', $request->eUUID)->update(['status' => 'planned', 'activeby' => $request->starttime, 'activeto' => $request->endtime]);


        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function endElection(Request $request){

        $election = Election::where('uuid', $request->eUUID)->update(['status' => 'ended']);


        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }
}
