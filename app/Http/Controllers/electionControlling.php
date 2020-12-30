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
                Election::where('uuid', $request->eUUID)->update(['status' => config('votestates.live.short')]);
            } else {
                return back()->with('activeError', 'Error: You have to create: Candidates, Voters and Terminals before you can start the election!');
            }

        } else {
            return abort(404);
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function activateWithTime(Request $request){
        $user = Auth::user();
        $electionID = Election::where('uuid', $request->eUUID)->firstOrFail()->id;
        if($user->hasPermissionTo($request->eUUID)){
            if(Candidate::where('election_id', $electionID)->count() != 0 AND Voter::where('election_id', $electionID)->count() != 0 AND Terminal::where('election_id', $electionID)->count() != 0){
                Election::where('uuid', $request->eUUID)->update(['status' => config('votestates.planed.short'), 'activeby' => $request->starttime, 'activeto' => $request->endtime]);
            } else {
                return back()->with('activeError', 'Error: You have to create: Candidates, Voters and Terminals before you can start the election!');
            }
        } else {
            return abort(404);
        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function endElection(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
           Election::where('uuid', $request->eUUID)->update(['status' => config('votestates.ended.short')]);
        } else {
            return abort(404);
        }

        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function sendEmails(Request $request) {
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            $electionProcessController = new electionProcessController($request->eUUID);
            $emailController = new emailController($request->eUUID);
            $voters = Voter::where([
                ['election_id', '=', $electionProcessController->getId($request->eUUID, 'elections')],
                ['got_email', '=', '0'],
            ])->get();
            $emailController->sendBulkInvations($voters, $request->terminalUUID);
        } else {
            return abort(404);

        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function planEmail(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            Election::where('uuid', $request->eUUID)->update(['email_send-time' => $request->starttimeEmail, 'email_terminal'=>$request->terminalUUID]);
        } else {
            return abort(404);

        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }
}
