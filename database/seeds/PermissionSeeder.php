<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permissions = [
         'view',
         'edit',
         'edit-election'
      ];


      foreach ($permissions as $permission) {
           Permission::create(['name' => $permission]);
      }
    }
}
