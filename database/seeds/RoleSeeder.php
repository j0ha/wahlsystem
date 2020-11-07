<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [
         'admin',
         'election-admin',
         'election-moderator',
         'election-user',
         'user',
      ];


      foreach ($roles as $role) {
           Permission::create(['name' => $role]);
      }
    }
}
