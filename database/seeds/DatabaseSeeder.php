<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ElectionsSeeder::class);
        $this->call(CandidatesSeeder::class);
        $this->call(TerminalsSeeder::class);
        $this->call(AddElectionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ModesSeeder::class);
    }
}
