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
      for ($i=0; $i < 10; $i++) {
        DB::table('classes')->insert([
            'name' => Str::random(10),
            'form_id' => rand(1, 5),
        ]);
      }
    }
}
