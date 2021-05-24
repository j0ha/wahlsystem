<?php

namespace App\Http\Controllers;

use App;
use App\Candidate;
use App\Form;
use App\Schoolclass;
use App\Terminal;
use App\User;
use Illuminate\Http\Request;
use App\Voter;
use App\Election;
use PDF;

class paperController extends Controller
{
    private $electionUUID;
    private $electionProcess;
    private $statsController;
    private $election;

    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->electionProcess = new electionProcessController($this->electionUUID);
        $this->statsController = new statsController($this->electionUUID);
        $this->election = Election::where('uuid', $electionUUID)->firstOrFail();
    }

    public function downloadSingelInvitation($voterUUID, $terminalUUID) {

        $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
        $election = Election::find($voter->election_id);
        $route = route('vote.direct', ['electionUUID'=>$election->uuid, 'terminalUUID'=>$terminalUUID, 'directUUID'=>$voter->direct_uuid]);
        $users = User::permission($election->uuid)->get();
        $pdf = PDF::loadView('pdf.invitation', ['voter'=>$voter, 'election' =>$election, 'route'=>$route, 'users'=>$users]);
        return $pdf->download($voter->name.$voter->surname.'_VoteInvitation_'.time().'.pdf');
    }

    public function downloadTerminals() {
        $terminals = Terminal::where('election_id', $this->election->id)->get();
        $pdf = PDF::loadView('pdf.terminals', ['terminals'=>$terminals, 'election' =>$this->election])->setOrientation('landscape');
        return $pdf->download($this->election->name.'_terminals_'.time().'.pdf');

    }

    public function downloadVoters() {
        $voters = Voter::where('election_id', $this->election->id)->get();
        $pdf = PDF::loadView('pdf.voters', ['voters'=>$voters, 'election' =>$this->election]);
        return $pdf->download($this->election->name.'_voters_'.time().'.pdf');

    }

    public function downloadCandidates() {
        $candidates = Candidate::where('election_id', $this->election->id)->get();
        $pdf = PDF::loadView('pdf.candidates', ['candidates'=>$candidates, 'election' =>$this->election]);
        return $pdf->download($this->election->name.'_candidates_'.time().'.pdf');

    }
    public function downloadSchoolclasses() {
        $schoolclasses = Schoolclass::where('election_id', $this->election->id)->get();
        $pdf = PDF::loadView('pdf.schoolclasses', ['schoolclasses'=>$schoolclasses, 'election' =>$this->election]);
        return $pdf->download($this->election->name.'_schoolclasses_'.time().'.pdf');

    }
    public function downloadForms() {
        $forms = Form::where('election_id', $this->election->id)->get();
        $pdf = PDF::loadView('pdf.forms', ['forms'=>$forms, 'election' =>$this->election]);
        return $pdf->download($this->election->name.'_forms_'.time().'.pdf');

    }

    public function downloadEvaluation() {


        //Die Election ID holen spart Codezeilen
        $electionID = $this->electionProcess->getId($this->electionUUID, 'elections');

        //Summe aller Stimmen
        $number_voters = Candidate::where('election_id', $electionID)->sum('votes');
        $number_voters_unpolled = Voter::where('election_id', $electionID)->where('voted_via_email', 0)->where('voted_via_terminal', 0)->count();
        //number_of_abstention

        //Wahlbeteiligung in %
        $stat_votes = Voter::where('election_id',  $this->electionProcess->getId($this->electionUUID, 'elections'))->where(function ($query){
            $query->where('voted_via_terminal', 1)->orWhere('voted_via_email', 1)->count();
        })->count();
        $stat_voters = Voter::where('election_id',  $this->electionProcess->getId($this->electionUUID, 'elections'))->count();

        //Auswertung der Wahl
        $votedistribution_candidates = Candidate::where('election_id', $electionID)->get();

        //Donuts + Graph
        $stat_schoolclassesVoteTurnout = $this->statsController->schoolclassesVoteTurnout($this->electionUUID);
        $stat_formVoterSpread = $this->statsController->formVoterSpread($this->electionUUID);
        $stat_terminalUsage = $this->statsController->terminalUsage($this->electionUUID);

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
