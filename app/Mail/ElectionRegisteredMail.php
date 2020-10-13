<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Election;
use App\User;
use App\Voter;


class ElectionRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $election;
     public $user;
     public $voter;

    public function __construct(Election $election, User $user, $tvoters)
    {
      $this->election = $election;
      $this->user = $user;
      $this->voter = $tvoters;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.election-registered');
    }
}
