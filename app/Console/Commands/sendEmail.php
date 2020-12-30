<?php

namespace App\Console\Commands;

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
        $time = date("Y-m-d H:i:00");
        $elections = Election::where('status', 'planned')->get();

        foreach($elections as $e){
            if($e->activeby == $time){
                Election::where('uuid', $e->uuid)->update(['status' => 'live']);
            }
        }
    }
}
