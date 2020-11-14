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
    public function indexHomeWithoutElection(){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      return view('layouts.backend_v2', compact('electionArray', 'user'));
    }

    public function indexDashboard($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      return view('backendviews.v2.dashboard',['electionUUID' => $electionUUID] , compact('electionArray', 'user'));
    }

    public function indexInformations($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);
      $selectedE = Election::where('uuid', $electionUUID)->get();


      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.electionInformations', ['electionUUID' => $electionUUID])->with(compact('selectedE', 'electionArray', 'user'));

      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexElectionStats($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.Stats',['electionUUID' => $electionUUID])->with(compact('electionArray'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexVoters($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.overview', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function votersAddSingle($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.add', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function votersAddMany($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.upload', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }
    // !!! End - ELECTION BACKEND !!!








    // !!! Profile BACKEND !!!
    public function indexProfile(){
      $locations = config('countries');

      $user = Auth::user();
      $allPermissions = $user->getAllPermissions();

      return view('layouts.profile', compact('allPermissions'))->withLocations($locations)->withUser($user);
    }

    public function updateProfile(Request $request){

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

      return redirect(route('profile.Data'));
    }

    public function deleteProfile(){

      $user = User::find(Auth::user()->id);

      $user->delete();

      return redirect('home');
    }

    // !!! End-Profile BACKEND !!!




    // !!! General Functions !!!

    public function electionPermission($u){

      $elections = Election::all();

      $earray = array();
      foreach($elections as $e){
        if($u->hasPermissionTo($e->permission_id)){
          $earray[] = $e;
        }
      }
      return $earray;
    }
    // !!! End - General Functions !!!


    // !!! Middleware !!!
    public function unauthorized(){
      return view('unauthorized');
    }
    // !!! End-Middleware !!!
}
