<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Http\Request;
use App\Voter;
use App\Election;
use PDF;

class paperController extends Controller
{
    private $electionUUID;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
    }

    public function downloadSingelInvitation($voterUUID) {

        $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
        $election = Election::find($voter->election_id);
        $route = url('/vote/'.$election->uuid.'/'.$voter->direct_uuid);

        $pdf = PDF::loadView('pdf.invitation', ['voter'=>$voter, 'election' =>$election, 'route'=>$route]);
        return $pdf->download($voter->name.$voter->surname.'_VoteInvitation_'.time().'.pdf');
    }

    public function downloadEvaluation() {

        $electionProcess = new electionProcessController;
        $statsController = new statsController;
        //Die Election ID holen spart Codezeilen
        $electionID = $electionProcess->getId($this->electionUUID, 'elections');

        //Summe aller Stimmen
        $number_voters = Candidate::where('election_id', $electionID)->sum('votes');
        $number_voters_unpolled = Voter::where('election_id', $electionID)->where('voted_via_email', 0)->where('voted_via_terminal', 0)->count();
        //number_of_abstention

        //Wahlbeteiligung in %
        $stat_votes = Voter::where('election_id',  $electionProcess->getId($this->electionUUID, 'elections'))->where(function ($query){
            $query->where('voted_via_terminal', 1)->orWhere('voted_via_email', 1)->count();
        })->count();
        $stat_voters = Voter::where('election_id',  $electionProcess->getId($this->electionUUID, 'elections'))->count();

        //Auswertung der Wahl
        $votedistribution_candidates = Candidate::where('election_id', $electionID)->get();

        //Donuts + Graph
        $stat_schoolclassesVoteTurnout = $statsController->schoolclassesVoteTurnout($this->electionUUID);
        $stat_formVoterSpread = $statsController->formVoterSpread($this->electionUUID);
        $stat_terminalUsage = $statsController->terminalUsage($this->electionUUID);

        $pdf = PDF::loadView('pdf.evaluation', ['number_voters'=>$number_voters, 'number_voters_unpolled' =>$number_voters_unpolled, 'stat_votes'=>$stat_votes, 'stat_schoolclassesVoteTurnout'=>$stat_schoolclassesVoteTurnout, 'stat_voters'=>$stat_voters, 'votedistribution_candidates'=>$votedistribution_candidates, 'stat_formVoterSpread'=>$stat_formVoterSpread, 'stat_terminalUsage'=>$stat_terminalUsage]);
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        $pdf->setOption('margin-bottom', 0);
        $pdf->setOption('margin-top', 0);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('lowquality', false);
        $pdf->setOption('disable-smart-shrinking', true);
        $pdf->setOption('images', true);
        $pdf->setOption('window-status', 'ready');
        $pdf->setOption('run-script', 'window.setTimeout(function(){window.status="ready";},5000);');

        return $pdf->download('Evaluation-Test.pdf');
        //redirect()->route('voters.view', ['electionUUID' => $election->uuid]);



    }
}
