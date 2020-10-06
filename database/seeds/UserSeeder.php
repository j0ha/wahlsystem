<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'surname' => "Wahlmacher",
          'name' => "Admin",
          'email' => "admin@einfachabstimmen.online",
          'password' => "keineahnung",
          'approved' => '1',

      ]);
    }
}
