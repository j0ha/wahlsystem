<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Terminal;
use App\Voter;
use Carbon\Carbon;
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
                $e = Election::where('uuid', $request->eUUID)->firstOrFail();
                $e->status = config('votestates.live.short');
                $e->realstart = Carbon::now(config('app.timezone'));
                $e->save();
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
                Election::where('uuid', $request->eUUID)->update(['status' => config('votestates.planned.short'), 'activeby' => new Carbon($request->starttime, config('app.timezone')), 'activeto' => new Carbon($request->endtime, config('app.timezone'))]);
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
           Election::where('uuid', $request->eUUID)->update(['status' => config('votestates.ended.short'), 'realend' => Carbon::now(config('app.timezone'))]);
        } else {
            return abort(404);
        }

        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function sendEmails(Request $request) {
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){
            $election = Election::where('uuid', $request->eUUID)->firstOrFail();
            if($election->email_terminal == null) {
                $electionProcessController = new electionProcessController($request->eUUID);
                $emailController = new emailController($request->eUUID);
                $voters = Voter::where([
                    ['election_id', '=', $electionProcessController->getId($request->eUUID, 'elections')],
                    ['got_email', '=', '0'],
                    ['direct_uuid', '!=', null],
                ])->get();
                $emailController->sendBulkInvations($voters, $request->terminalUUID);
                $time = new Carbon(Carbon::now(), config('app.timezone'));
                Election::where('uuid', $request->eUUID)->update(['email_sendtime' => $time, 'email_terminal'=>$request->terminalUUID]);
            } else {
                return back()->with('emailError', 'Error: The election already sent E-Mails to every Voter, you still can send them individualy');
            }

        } else {
            return abort(404);

        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }

    public function planEmail(Request $request){
        $user = Auth::user();
        if($user->hasPermissionTo($request->eUUID)){

            if($request->terminalUUID != null) {
                $election = Election::where('uuid', $request->eUUID)->firstOrFail();
                if($election->email_terminal == null) {
                    $time = new Carbon($request->starttimeEmail, config('app.timezone'));
                    Election::where('uuid', $request->eUUID)->update(['email_sendtime' => $time, 'email_terminal'=>$request->terminalUUID]);
                } else {
                    return back()->with('emailError', 'Error: The election already sent E-Mails to every Voter, you still can send them individualy');
                }
            } else {
                return back()->with('emailError', 'Error: please select a terminal!');
            }
        } else {
            return abort(404);

        }
        return redirect()->route('election.Controlling', ['electionUUID' => $request->eUUID]);
    }
}
