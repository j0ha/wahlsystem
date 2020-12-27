<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use Illuminate\Support\Facades\Auth;

class electionControlling extends Controller
{
    public function activate(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            $election = Election::where('uuid', $request->eUUID)->update(['status' => 'live']);
        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function activateWithTime(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            $election = Election::where('uuid', $request->eUUID)->update(['status' => 'planned', 'activeby' => $request->starttime, 'activeto' => $request->endtime]);
        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function endElection(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            $election = Election::where('uuid', $request->eUUID)->update(['status' => 'ended']);
        } else {
            echo "Du PENNER HAST KEINEN ZUGRIFF!";
        }

        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }
}
