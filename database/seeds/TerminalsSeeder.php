<?php

use Illuminate\Database\Seeder;

class TerminalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('terminals')->insert([
          'name' => Str::random(10),
          'kind' => "browser",
          'description' => "example",
          'position' => "Hall A Room 12",
          'uuid' => Str::uuid(),
          'election_id' => 1,
      ]);
    }
}
