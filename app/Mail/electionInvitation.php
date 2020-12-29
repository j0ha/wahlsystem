<?php

namespace App\Mail;

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

    public function __construct($election, $terminalUUID, $voter)
    {
        $this->voter = $voter;
        $this->election = $election;
        $this->route = route('vote.direct', ['electionUUID'=>$this->election->uuid,'terminalUUID'=>$terminalUUID, 'directUUID'=>$this->voter->direct_uuid]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $pdf = PDF::loadView('pdf.invitation', ['voter'=>$this->voter, 'election' =>$this->election, 'route'=>$this->route]);

      return $this->markdown('emails.electionInvitation')->attachData($pdf->inline(), 'Invitation.pdf');
    }
}
