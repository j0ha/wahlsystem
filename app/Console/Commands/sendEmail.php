<?php

namespace App\Console\Commands;

use App\Election;
use App\Http\Controllers\electionProcessController;
use App\Http\Controllers\emailController;
use App\Voter;
use Carbon\Carbon;
use Illuminate\Console\Command;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'election:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command with send the informations to the selected elections at a specific timetable.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $time = new Carbon(Carbon::now(config('app.timezone'))->format('Y-m-d H:i:00'));
        $elections = Election::where('email_sendtime', '!=', null)->get();

        foreach($elections as $e){
            $time_election = new Carbon($e->email_sendtime, config('app.timezone'));
            if($time->equalTo($time_election)){
                $electionProcessController = new electionProcessController($e->uuid);
                $emailController = new emailController($e->uuid);
                $voters = Voter::where([
                    ['election_id', '=', $electionProcessController->getId($e->uuid, 'elections')],
                    ['got_email', '=', '0'],
                    ['direct_uuid', '!=', null],
                ])->get();
                $emailController->sendBulkInvations($voters, $e->email_terminal);
            }
        }
    }
}
