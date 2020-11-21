<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voter;
use App\Election;
use PDF;

class paperController extends Controller
{
    public function downloadSingelInvitation($voterUUID) {

        $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
        $election = Election::find($voter->election_id);
        $route = url('/vote/'.$election->uuid.'/'.$voter->direct_uuid);

        $pdf = PDF::loadView('pdf.invitation', ['voter'=>$voter, 'election' =>$election, 'route'=>$route]);

        return $pdf->download($voter->name.$voter->surname.'_VoteInvitation_'.time().'.pdf', $voter);

    }
}
