<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class backendController extends Controller
{
    // !!! ELECTION BACKEND !!!
    public function homewithoutelection(){
      $electionArray = Self::electionPermission();

      return view('backendviews.backendhome', compact('electionArray'));
    }

    public function home($electionUUID){
      $electionArray = Self::electionPermission();
      $selectedE = Election::where('uuid', $electionUUID)->get();

      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->with(compact('selectedE', 'electionArray'));
    }

    public function stats($electionUUID){
      $electionArray = Self::electionPermission();

      return view('backendviews.Stats',['electionUUID' => $electionUUID])->with(compact('electionArray'));
    }

    public function voter($electionUUID){
      $electionArray = Self::electionPermission();

      return view('backendviews.VotersTable', ['electionUUID' => $electionUUID])->with(compact('electionArray'));
    }

    public function voteradd($electionUUID){
      $electionArray = Self::electionPermission();

      return view('backendviews.AddSingleV', ['electionUUID' => $electionUUID])->with(compact('electionArray'));
    }

    public function bulkaddV($electionUUID){
      $electionArray = Self::electionPermission();

      return view('backendviews.AddMultipleV', ['electionUUID' => $electionUUID])->with(compact('electionArray'));
    }
    // !!! End - ELECTION BACKEND !!!








    // !!! Profile BACKEND !!!
    public function pdata(){
      $locations = config('countries');

      $user = Auth::user();

      return view('layouts.profile')->withLocations($locations)->withUser($user);
    }

    public function updatepData(Request $request){

      $user = User::find(Auth::user()->id);

      if(!empty($request->input('location'))){
        $validateLocation = $request->validate([
          'location' => 'required',
        ]);
        $user->location = $request->input('location');
      }
      if(!empty($request->input('city'))){
        $validateCity = $request->validate([
          'city' => 'required|max:255|alpha',
        ]);
        $user->city = $request->input('city');
      }
      if(!empty($request->input('institution'))){
        $validateInstitution = $request->validate([
          'institution' => 'required|max:255',
        ]);
        $user->institution = $request->input('institution');
      }
      $user->save();

      return redirect(route('profileData'));
    }

    public function deleteAcc(){

      $user = User::find(Auth::user()->id);

      $user->delete();

      return redirect('home');
    }

    public function permission(){

      $user = Auth::user();



      return view('permissionTestingView')->withUser($user);
    }
    // !!! End-Profile BACKEND !!!




    // !!! General Functions !!!

    public function electionPermission(){
      $user = Auth::user();
      $elections = Election::all();

      $earray = array();
      foreach($elections as $e){
        if($user->hasPermissionTo($e->permission_id)){
          $earray[] = $e;
        }
      }
      return $earray;
    }
    // !!! End - General Functions !!!
}
