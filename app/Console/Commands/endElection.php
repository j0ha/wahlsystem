<?php

namespace App\Console\Commands;

use App\Election;
use Carbon\Carbon;
use Illuminate\Console\Command;

class endElection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'election:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will set the status of an election that is live but planned to END at a different time to "ended"';

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
        $elections = Election::where('status', 'live')->get();
        foreach($elections as $e){
            $time_election = new Carbon($e->activeto, config('app.timezone'));
            if($time->equalTo($time_election)){
                $e->status = config('votestates.ended.short');
                $e->realend = Carbon::now(config('app.timezone'));
                $e->save();
            }
        }
    }
}
