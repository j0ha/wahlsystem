<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Terminal;
use App\Voter;
use Illuminate\Http\Request;
use App\Election;
use Illuminate\Support\Facades\Auth;

class electionControlling extends Controller
{
    public function activate(Request $request){
        $user = Auth::user();
        $electionID = Election::where('uuid', $request->eUUID)->firstOrFail()->id;
        if($user->hasPermissionTo($request->eUUID)){
            if(Candidate::where('election_id', $electionID)->count() != 0 AND Voter::where('election_id', $electionID)->count() != 0 AND Terminal::where('election_id', $electionID)->count() != 0){
                Election::where('uuid', $request->eUUID)->update(['status' => 'live']);
            } else {
                return "Error: You have to create: Candidates, Voters and Terminals before you can start the election!";
            }

        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function activateWithTime(Request $request){
        $user = Auth::user();
        $electionID = Election::where('uuid', $request->eUUID)->firstOrFail()->id;
        if($user->hasPermissionTo($request->eUUID)){
            if(Candidate::where('election_id', $electionID)->count() != 0 AND Voter::where('election_id', $electionID)->count() != 0 AND Terminal::where('election_id', $electionID)->count() != 0){
                Election::where('uuid', $request->eUUID)->update(['status' => 'planned', 'activeby' => $request->starttime, 'activeto' => $request->endtime]);
            } else {
                return"Error: You have to create: Candidates, Voters and Terminals before you can start the election!";
            }
        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function endElection(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
           Election::where('uuid', $request->eUUID)->update(['status' => 'ended']);
        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }

        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }
}
