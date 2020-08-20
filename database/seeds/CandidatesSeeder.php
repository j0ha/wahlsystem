<?php

use Illuminate\Database\Seeder;

class CandidatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 3; $i++) {
        DB::table('candidates')->insert([
            'name' => Str::random(10),
            'election_id' => 1,
            'uuid' => Str::uuid(),
        ]);
      }
    }
}
