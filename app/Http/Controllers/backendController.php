<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Candidate;
use App\Voter;
use App\Form;
use App\Schoolclass;
use App\Http\Controllers\electionProcessController;

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
      $electionProcess = new electionProcessController;

      $stat_voters = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->count();
      $stat_questions = Candidate::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->count();
      $stat_votes = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->where('voted_via_email', 1)->Orwhere('voted_via_terminal', 1)->count();

      return view('backendviews.v2.dashboard',['electionUUID' => $electionUUID] , compact('electionArray', 'user', 'stat_voters', 'stat_questions', 'stat_votes'));
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

    public function indexCandidates($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.candidates.overview', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
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
      $selectedE = Election::where('uuid', $electionUUID)->firstOrFail()->id;
      $forms = Form::where('election_id', $selectedE)->get();
      $classes = Schoolclass::where('election_id', $selectedE)->get();

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.add', ['electionUUID' => $electionUUID], compact('electionArray', 'user', 'forms', 'classes'));
      } else {
        return redirect()->route('unauthorized');
      }
    }
    public function votersAddSingleInsert(Request $request){

      $voter = new Voter;

      $voter->surname = $request->voterSurname;
      $voter->name = $request->voterName;
      $voter->birth_year = $request->voterDate;
      $voter->uuid = Str::uuid();
      $voter->direct_uuid = Str::uuid();
      $voter->email = $request->voterEmail;
      $voter->election_id = Election::where('uuid', $request->electionUUID)->firstOrFail()->id;

      $voter->schoolclass_id = $request->voterClass;
      $voter->form_id = $request->voterForm;

      $voter->save();

      return redirect(route('voters.view', ['electionUUID' => $request->electionUUID]));

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

    public function indexTerminals($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.terminals', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexSchoolclass($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.schoolclasses', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexSchoolgrade($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.schoolgrades', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
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
