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
      $password = "keineahnung";
      DB::table('users')->insert([
          'surname' => "Wahlmacher",
          'name' => "Admin",
          'email' => "admin@einfachabstimmen.online",
          'password' => Hash::make($password),
          'approved' => '1',

      ]);
    }
}
