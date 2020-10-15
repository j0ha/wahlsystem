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
      $password = "12345678";
      DB::table('users')->insert([
          'surname' => "Wahlmacher",
          'name' => "Admin",
          'email' => "admin@einfachabstimmen.online",
          'password' => Hash::make($password),
          'approved' => '1',

      ]);
      DB::table('users')->insert([
          'surname' => "johannes",
          'name' => "Admin",
          'email' => "jo@hann.es",
          'password' => Hash::make($password),
          'approved' => '1',

      ]);
    }
}
