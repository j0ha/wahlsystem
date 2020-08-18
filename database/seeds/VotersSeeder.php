<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VotersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 400; $i++) {
        DB::table('voters')->insert([
            'surname' => Str::random(8),
            'name' => Str::random(10),
            'birth_year' => Carbon::parse('2000-01-01'),
            'uuid' => Str::uuid(),
            'election_id' => 1,
            'schoolclass_id' => rand(1, 20),
            'form_id' => rand(1, 5),
        ]);
      }

    }
}
