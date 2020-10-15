<?php

use Illuminate\Database\Seeder;

class ElectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('elections')->insert([
          'name' => Str::random(8),
          'abstention' => false,
          'uuid' => Str::uuid(),
          'status' => "active",
          'type' => "spv"
      ]);
    }
}
