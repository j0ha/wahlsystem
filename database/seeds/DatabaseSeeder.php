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
        $this->call(VotersSeeder::class);
        $this->call(ElectionsSeeder::class);
        $this->call(CandidatesSeeder::class);
        $this->call(TerminalsSeeder::class);
    }
}
