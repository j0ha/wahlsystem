<?php

use Illuminate\Database\Seeder;

class ModesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('modes')->insert([
          'mode' => 'ssw',
          'name' => 'Schülersprecherwahl',
      ]);
      DB::table('modes')->insert([
          'mode' => 'token',
          'name' => 'Tokenwahl',
      ]);
      DB::table('modes')->insert([
          'mode' => 'bw',
          'name' => 'Bürgerschaftswahl',
      ]);
    }
}
