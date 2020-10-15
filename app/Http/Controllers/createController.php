<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\electionProcessController;
use App\Mode;
use App\Election;
use App\Voter;

class createController extends Controller
{


    public function index(){
      return view('electionCreation');
    }

    public function insert(Request $request){

        $validatedData = $request->validate([
          'electionName' => 'required|max:255|alpha_dash',
          'electionDescription' => 'required|min:2|max:100|numeric',
          'electionMode' => 'required'
        ]);

          $e = new Election;

          $e->name = $request->electionName;
          $e->participants = $request->electionDescription;
          $e->abstention = 1;
          $e->status = "active";
          $e->uuid = $uuid=Str::uuid();
          $e->type = $request->electionMode;
          $e->save();

      /*
        User bekommt eine Mail mit dem Inhalt, dass er erfolgreich eine Wahl erstellt hat, die
        den Namen Xyz hat.
        Mail::to(Auth::user()->email)
          //->cc($moreUsers)
          //->bcc($evenMoreUsers)
          ->queue(new ElectionRegisteredMail($e, Auth::user()));
        */


          //!!!!!!!!!!!!!!!!!!!!
          /*Returns back to the creation form? With a Succes Alert! Later returns to backend where the user
          can see all of his elections he has active*/
          return "Test";


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
}
