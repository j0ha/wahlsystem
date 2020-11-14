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

        $faker = Faker\Factory::create();
        $ci = 0;
        $a = 1;
        // for ($a=1; $a < 2; $a++) {
        //   DB::table('elections')->insert([
        //       'name' => $faker->jobTitle,
        //       'id' => $a,
        //       'description' => $faker->text($maxNbChars = 200),
        //       'abstention' => false,
        //       'uuid' => Str::uuid(),
        //       'status' => "active",
        //       'type' => "spv"
        //   ]);

          for ($b=0; $b < 3; $b++) {
            DB::table('candidates')->insert([
                'name' => $faker->jobTitle,
                'description' => $faker->bs,
                'image' => $faker->imageUrl($width = 640, $height = 900),
                'election_id' => $a,
                'uuid' => Str::uuid(),
                'type' => 'spt',
                'level' => 0,
            ]);
          }

          for ($x=0; $x < 10; $x++) {
            DB::table('terminals')->insert([
                'name' => $faker->country,
                'kind' => "browser",
                'description' => $faker->catchPhrase,
                'position' => $faker->city,
                'uuid' => Str::uuid(),
                'election_id' => $a,
                'status' => "active",
            ]);
          }


          for ($i=5; $i < 14; $i++) {
            DB::table('forms')->insert([
                'name' => "Jahrgang " . $i,
                'election_id' => $a,
                'uuid' => Str::uuid(),
            ]);

            for ($ii=1; $ii < 7; $ii++) {
              DB::table('classes')->insert([
                  'name' => "Klasse " . $ii,
                  'election_id' => $a,
                  'form_id' => $i,
                  'uuid' => Str::uuid(),
                ]);
              $ci++;
              for ($iii=0; $iii < 23; $iii++) {
                DB::table('voters')->insert([
                    'surname' => $faker->firstName,
                    'name' => $faker->lastName,
                    'birth_year' => $faker->date($format = 'Y-m-d', $max = 'now'),
                    'uuid' => Str::uuid(),
                    'direct_uuid' => Str::uuid(),
                    'election_id' => $a,
                    'schoolclass_id' => $ci,
                    'form_id' => $i,
                    'email' => $faker->email,
                ]);
              }
            }
          }


        // }

      }

}
