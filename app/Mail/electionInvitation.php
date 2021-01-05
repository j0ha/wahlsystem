<?php

namespace App\Mail;

use App\User;
use App\Voter;
use App\Election;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class electionInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $route;
    public $voter;
    public $election;
    public $users;

    public function __construct($election, $terminalUUID, $voter)
    {
        $this->voter = $voter;
        $this->election = $election;
        $this->route = route('vote.direct', ['electionUUID'=>$this->election->uuid,'terminalUUID'=>$terminalUUID, 'directUUID'=>$this->voter->direct_uuid]);
        $this->users =  User::permission($this->election->uuid)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


      if(config('system.INVITATION_PDF') == 1) {
          $pdf = PDF::loadView('pdf.invitation', ['voter'=>$this->voter, 'election' =>$this->election, 'route'=>$this->route, 'users'=>$this->users]);
          return $this->markdown('emails.electionInvitation')->attachData($pdf->inline(), 'Invitation_'.$this->voter->surname.time().'.pdf');
      } else {
          return $this->markdown('emails.electionInvitation');
      }
    }
}
