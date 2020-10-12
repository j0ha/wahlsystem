<?php

namespace App\Http\Controllers\electiontypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class token extends Controller
{

  public function index(){
    return view('tokenTest');
  }

  public function insert(Request $request){

    $dataBug = intVal('emailelectioncount');

    $validatedData = $request->validate([
      'tokenVName' => 'required|max:255|alpha_dash',
      'tokenVPartisipants' => 'required|min:2|max:100',
      'tokenVAbstention' => 'required'
    ]);


    if($validatedData == false){

      /* Should return the same page (tokenTest) with the errormessages that arise out of the validator*/

      return "error";

      } else {

        $tokenV = new Election;

        $tokenV->name = $request->tokenVName;
        $tokenV->participants = $request->tokenVPartisipants;
        $tokenV->abstention = $request->tokenVAbstention;
        $tokenV->uuid = Str::uuid();
        $tokenV->save();


        /*
        DB::table('emailelections')->insert([
          'name' => 'emailelectionname',
          'participants' => $dataBug,
          'abstention' => 1,
          'status' => "active",
          'uuid' => $uuid,
        ]);
        */

      }



    //Function that gets the election id of the inserted election

    //$emailvoteId = getId($uuid, 'emailelections');




    //Function that inserts x->participants with each own UUID
        //Function that creates the links

  /*  for($i = 0; $i < $participants; $i++){

      $evoter = new Emailvoter();

      $evoter->save();

    }

    */

        //Timestamp Carbon

    //Function that mails all the links numbered to the election-owner
      //mailCube



  }

}
