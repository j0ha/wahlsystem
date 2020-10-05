<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AddElectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ci = 0;
        for ($i=5; $i < 14; $i++) {
          DB::table('forms')->insert([
              'name' => "Jahrgang " . $i,
              'election_id' => 1,
              'uuid' => Str::uuid(),
          ]);

          for ($ii=1; $ii < 7; $ii++) {
            DB::table('classes')->insert([
                'name' => "Klasse " . $ii,
                'election_id' => 1,
                'form_id' => $i,
                'uuid' => Str::uuid(),
              ]);
            $ci++;
            for ($iii=0; $iii < 23; $iii++) {
              DB::table('voters')->insert([
                  'surname' => Str::random(8),
                  'name' => Str::random(10),
                  'birth_year' => Carbon::parse('2000-01-01'),
                  'uuid' => Str::uuid(),
                  'direct_uuid' => Str::uuid(),
                  'election_id' => 1,
                  'schoolclass_id' => $ci,
                  'form_id' => $i,
                  'email' => Str::random(5). "." .Str::random(5). "@sch.ur",
              ]);
            }
          }
        }
      }

}
