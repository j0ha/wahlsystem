<?php

use Illuminate\Database\Seeder;

class SchoolclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 20; $i++) {
        DB::table('classes')->insert([
            'name' => Str::random(10),
            'election_id' => 1,
        ]);
      }
    }
}
