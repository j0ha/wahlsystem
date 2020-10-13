<?php

namespace App\Http\Controllers\electiontypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\electionProcessController;
use Auth;
use App\Election;
use App\Voter;
use App\Mail\ElectionRegisteredMail;



class token extends Controller
{

  /* VIEW INDEX METHOD --- VIEW INDEX METHOD --- VIEW INDEX METHOD --- */
  public function index(){
    return view('/tokenTest');
  }
  /* VIEW INDEX METHOD --- VIEW INDEX METHOD --- VIEW INDEX METHOD --- */

  /* DATA BASE INSERT METHOD --- DATA BASE INSERT METHOD --- DATA BASE INSERT METHOD ---*/
  public function insert(Request $request){


    $validatedData = $request->validate([
      'tokenVName' => 'required|max:255|alpha_dash',
      'tokenVPartisipants' => 'required|min:2|max:100|numeric',
      'tokenVAbstention' => 'required|boolean'
    ]);


    /*if($validatedData == false){
      //!!!!!!!!!!!!!!!!!!!!!
      /* Should return the same page (tokenTest) with the errormessages that arise out of the validator*/
    //  return "Error";
      //return back()->withInput()->with('input_error', "Der gegebene Input war leider nicht richtig.");

    //} else {

        $tokenV = new Election;

        $tokenV->name = $request->tokenVName;
        $tokenV->participants = $request->tokenVPartisipants;
        $tokenV->abstention = $request->tokenVAbstention;
        $tokenV->status = 0;
        $tokenV->uuid = $uuid=Str::uuid();
        $tokenV->type = 'token';
        $tokenV->save();

    //}


    //Function that gets the election id of the inserted election
    $tokenElectionId = electionProcessController::getId($uuid, 'elections');

    //Function that inserts x->participants with each own UUID
    Self::voterCreation($request->tokenVPartisipants, $tokenElectionId);
        //Timestamp Carbon

    //Query die alle Voter mit der Election_ID (X) in einer Varibale Speichert
    $tokenvoters = DB::table('voters')
                            ->where('election_id',$tokenElectionId)
                            ->get();

    //Function that mails all the links numbered to the election-owner

    Mail::to(Auth::user()->email)
      //->cc($moreUsers)
      //->bcc($evenMoreUsers)
      ->queue(new ElectionRegisteredMail($tokenV, Auth::user(), $tokenvoters));

      //Mail::to(Auth::user()->email)->send(new ElectionRegisteredMail());

      //!!!!!!!!!!!!!!!!!!!!
      /*Returns back to the creation form? With a Succes Alert! Later returns to backend where the user
      can see all of his elections he has active*/
      return back();


  }
  /* DATA BASE INSERT METHOD --- DATA BASE INSERT METHOD --- DATA BASE INSERT METHOD ---*/

  /* FUNCTION THAT CREATES THE VOTERS FROM X-> PARTICIPANTS */
  public function voterCreation(int $number, int $election){

    for($i = 0; $i < $number; $i++){

      $eVoter = new Voter;

      $eVoter->uuid = Str::uuid();
      $eVoter->direct_uuid = Str::uuid();
      $eVoter->direct_token = Str::uuid();
      $eVoter->election_id = $election;


      $eVoter->save();


    }

  }
  /* FUNCTION THAT CREATES THE VOTERS FROM X-> PARTICIPANTS */

}
