<?php

use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 5; $i++) {
        DB::table('forms')->insert([
            'name' => Str::random(10),
            'election_id' => 1,
        ]);
      }
    }
}
