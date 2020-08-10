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
      for ($i=0; $i < 10; $i++) {
        DB::table('voters')->insert([
            'surname' => Str::random(8),
            'name' => Str::random(10),
            'birth_year' => Carbon::parse('2000-01-01'),
            'uuid' => Str::uuid(),
        ]);
      }

    }
}
