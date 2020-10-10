<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Http\Controllers\electionProcessController;

class EmailElectionController extends Controller
{
    public function insert(Request $request){

      $dataBug = intVal('emailelectioncount');
      $uuid = Str::uuid();

      $validatedData = $request->validate([
        'emailelectionname' => 'required|max:255|alpha_dash',
        'emailelectioncount' => 'required|min:2|max:100',
        'abstentionselector' => 'required'
      ]);


      if($validatedData == false){

        return "Error";


        } else {

          $emailelection = new Emailelection();

          $emailelection-> = $request->emailelectionname;

          $emailelection->save();

          /*

          */


          DB::table('emailelections')->insert([
            'name' => 'emailelectionname',
            'participants' => $dataBug,
            'abstention' => 1,
            'status' => "active",
            'uuid' => $uuid,
          ]);

        }



      //Function that gets the election id of the inserted election

      $emailvoteId = getId($uuid, 'emailelections');




      //Function that inserts x->participants with each own UUID
          //Function that creates the links

      for($i = 0; $i < $participants; $i++){

        $evoter = new Emailvoter();

        $evoter->save();

      }



          //Timestamp Carbon

      //Function that mails all the links numbered to the election-owner
        //mailCube



    }


}
