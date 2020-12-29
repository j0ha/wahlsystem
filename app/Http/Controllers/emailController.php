<?php

namespace App\Http\Controllers;

use App\Election;
use App\Mail\electionInvitation;

use App\Terminal;
use App\Voter;
use Bugsnag;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    private $election;
    private $securityController;
    private $securityreporer;
    private $terminalController;

    public function __construct($electionUUID)
    {
        $this->election = Election::where('uuid', $electionUUID)->firstOrFail();
        $this->securityController = new securityController($this->election->uuid);
        $this->securityreporer = new securityreporterController($this->election->uuid);
        $this->terminalController = new terminalController($this->election->uuid);
    }

    public function sendSingelInvation($voterUUID, $terminalUUID) {
        try {
            $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
        } catch(\Exception $e) {
            $this->securityreporer->report('did not found terminal', 4, get_class(), null, $e);
            Bugsnag::notifyException($e);
        }


        if ($this->securityController->verifyToElection('voter', $voterUUID) == true AND $terminal->kind == config('terminalkinds.email.short') AND $this->terminalController->verifyTruthiness($terminalUUID) == true) {
            $voter = Voter::where('uuid', $voterUUID)->firstOrFail();
            Mail::to($voter->email)->queue(new electionInvitation($this->election, $terminalUUID, $voter));
            $voter->got_email = true;
            $voter->save();
        } else {
            $this->securityreporer->report('tried to send email to voter who does not fit to election or with wrong terminal', 4, get_class(), null, null);
        }
    }

    public function sendBulkInvations($voters, $terminalUUID) {
        try {
            $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();
        } catch(\Exception $e) {
            $this->securityreporer->report('did not found terminal', 4, get_class(), null, $e);
            Bugsnag::notifyException($e);
        }
        foreach ($voters as $voter) {
            if ($this->securityController->verifyToElection('voter', $voter->uuid) == true AND $terminal->kind == config('terminalkinds.email.short') AND $this->terminalController->verifyTruthiness($terminalUUID) == true) {
                $voter = Voter::where('uuid', $voter->uuid)->firstOrFail();
                Mail::to($voter->email)->queue(new electionInvitation($this->election, $terminalUUID, $voter));
                $voter->got_email = true;
                $voter->save();
            } else {
                $this->securityreporer->report('tried to send email to voter who does not fit to election or with wrong terminal', 4, get_class(), null, null);
            }
        }
    }
}
