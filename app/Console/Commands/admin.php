<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:makeAdmin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will grant an user the admin Role!';

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
        $role = Role::where('name', 'admin')->first();

        if(empty($role)) {
             Role::create(['name' => 'admin']);
        }

        $userMail = $this->argument('email');

        $user = User::where('email', $userMail)->firstOrFail();

        $user->assignRole('admin');

        info('The user:'.$user->name.'hat been granted to the role admin.');
    }
}
