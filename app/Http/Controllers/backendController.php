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
      $elections = Election::all();

      return view('backendviews.backendhome')->withElections($elections);
    }

    public function home($electionUUID){
      $elections = Election::all();
      $selectedE = Election::where('uuid', $electionUUID)->get();
      return view('backendviews.BasicInfos', ['electionUUID' => $electionUUID])->withElections($elections)->with(compact('selectedE'));
    }

    public function stats($electionUUID){
      $elections = Election::all();



      return view('backendviews.Stats',['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function voter($electionUUID){
      $elections = Election::all();

      return view('backendviews.VotersTable', ['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function voteradd($electionUUID){
      $elections = Election::all();

      return view('backendviews.AddSingleV', ['electionUUID' => $electionUUID])->withElections($elections);
    }

    public function bulkaddV($electionUUID){
      $elections = Election::all();

      return view('backendviews.AddMultipleV', ['electionUUID' => $electionUUID])->withElections($elections);
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
    // !!! End-Profile BACKEND !!!
}
