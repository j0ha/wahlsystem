<?php

namespace App\Console\Commands;

use App\Election;
use Carbon\Carbon;
use Illuminate\Console\Command;

class startElection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'election:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will set the status of an election that is waiting but planned to START at a different time to "live"';

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
        $elections = Election::where('status', 'planned')->get();
        foreach($elections as $e){
            $time_election = new Carbon($e->activeby, config('app.timezone'));
            if($time->equalTo($time_election)){

                $e->status = config('votestates.live.short');
                $e->realstart = Carbon::now(config('app.timezone'));
                $e->save();
            }
        }




    }
}
