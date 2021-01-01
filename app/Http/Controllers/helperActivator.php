<?php

namespace App\Http\Controllers;

use App\Election;
use App\Helper;
use App\User;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class helperActivator extends Controller
{
    public function helperActivate($token){
        $helper = Helper::where('token', $token)->firstOrFail();
        $election = Election::where('id', $helper->election_id)->get();

        if(!empty($helper)){
            return view('helperAcceptingForm', compact('election', 'helper'));
        } else {
            return abort(404);
        }

    }

    public function helpAccept(Request $request){
        $helper = Helper::where('token', $request->token)->firstOrFail();
        $user = User::where('email', $helper->email)->firstOrFail();
        $election = Election::where('uuid', $request->eUUID)->firstOrFail();

        $user->givePermissionTo($election->uuid);

        Helper::where('token', $request->token)->delete();

        return redirect(route('election.Dashboard', ['electionUUID' => $election->uuid]));
    }

    public function helpDecline(Request $request){
        Helper::where('token', $request->token)->delete();

        return redirect(route('home'));
    }
}
