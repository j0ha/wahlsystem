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

     public $voter;
     public $election;
     public $route;

    public function __construct($voterUUID)
    {
        $this->voter = Voter::where('uuid', $voterUUID)->firstOrFail();
        $this->election = Election::find($this->voter->election_id);
        $this->route = url('/vote/'.$this->election->uuid.'/'.$this->voter->direct_uuid);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $pdf = PDF::loadView('pdf.invitation', ['voter'=>$this->voter, 'election' =>$this->election, 'route'=>$this->route]);

      // return $pdf->download($voter->name.$voter->surname.'_VoteInvitation_'.time().'.pdf', $voter);

        return $this->markdown('emails.electionInvitation')->attachData($pdf->inline(), 'name.pdf');
    }
}
