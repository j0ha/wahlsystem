<?php

namespace App\Http\Controllers;

use App\Http\Controllers\electionProcessController;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use App\Election;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use App\Voter;
use App\Form;
use App\Schoolclass;
use App\Candidate;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;



class backendController extends Controller
{
      /*************************************************************
      *************************************************************
                           BEGINNING BACKENDPAGES
      *************************************************************
      **************************************************************/


     /*==============================================================
                            BEGIN INDEXPAGES
     ==============================================================*/
    public function indexHomeWithoutElection(){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

        return view('layouts.backend_v2', compact('electionArray', 'user'));
    }

    public function indexDashboard($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);
      $electionProcess = new electionProcessController;
      $statsController = new statsController;


      $stat_voters = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->count();
      $stat_questions = Candidate::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->count();
      $stat_votes = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->where(function ($query){
          $query->where('voted_via_terminal', 1)->orWhere('voted_via_email', 1)->count();
      })->count();
      $stat_terminalUsage = $statsController->terminalUsage($electionUUID);
      $stat_terminals = $statsController->terminals($electionUUID);
      $stat_schoolclassesSpread = $statsController->schoolclassesSpread($electionUUID);
      $stat_formVoterSpread = $statsController->formVoterSpread($electionUUID);
      $stat_schoolclassesVoteTurnout = $statsController->schoolclassesVoteTurnout($electionUUID);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.dashboard',['electionUUID' => $electionUUID] , compact('electionArray', 'user', 'stat_voters', 'stat_questions', 'stat_votes', 'stat_terminalUsage', 'stat_terminals', 'stat_schoolclassesSpread', 'stat_formVoterSpread', 'stat_schoolclassesVoteTurnout'));

      } else {
        return redirect()->route('unauthorized');
      }

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

    public function indexControlling($electionUUID){
        $user = Auth::user();
        $electionArray = Self::electionPermission($user);
        $selectedE = Election::where('uuid', $electionUUID)->get();

        if ($user->hasPermissionTo($electionUUID)) {
            return view('backendviews.v2.electioncontrolling', ['electionUUID' => $electionUUID], compact('electionArray', 'user', 'selectedE'));
        } else {
            return redirect()->route('unauthorized');
        }
    }

    public function indexEvaluation($electionUUID){
        $user = Auth::user();
        $electionArray = Self::electionPermission($user);
        //Erzeuge neue Objekte
        $electionProcess = new electionProcessController;
        $statsController = new statsController;
        //Die Election ID holen spart Codezeilen
        $electionID = $electionProcess->getId($electionUUID, 'elections');

        //Summe aller Stimmen
        $number_voters = Candidate::where('election_id', $electionID)->sum('votes');
        $number_voters_unpolled = Voter::where('election_id', $electionID)->where('voted_via_email', 0)->where('voted_via_terminal', 0)->count();
        //number_of_abstention

        //Wahlbeteiligung in %
        $stat_votes = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->where(function ($query){
            $query->where('voted_via_terminal', 1)->orWhere('voted_via_email', 1)->count();
        })->count();
        $stat_voters = Voter::where('election_id',  $electionProcess->getId($electionUUID, 'elections'))->count();

        //Auswertung der Wahl
        $votedistribution_candidates = Candidate::where('election_id', $electionID)->get();

        //Donuts + Graph
        $stat_schoolclassesVoteTurnout = $statsController->schoolclassesVoteTurnout($electionUUID);
        $stat_formVoterSpread = $statsController->formVoterSpread($electionUUID);
        $stat_terminalUsage = $statsController->terminalUsage($electionUUID);


        if ($user->hasPermissionTo($electionUUID)) {
            return view('backendviews.v2.evaluation', ['electionUUID' => $electionUUID], compact('electionArray', 'user', 'number_voters', 'number_voters_unpolled', 'votedistribution_candidates', 'stat_schoolclassesVoteTurnout', 'stat_terminalUsage', 'stat_votes', 'stat_voters', 'stat_formVoterSpread'));
        } else {
            return redirect()->route('unauthorized');
        }
    }

    public function indexSecurityreporter($electionUUID){
        $user = Auth::user();
        $electionArray = Self::electionPermission($user);

        if ($user->hasPermissionTo($electionUUID)) {
            return view('backendviews.v2.securityreporter', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
        } else {
            return redirect()->route('unauthorized');
        }
    }
    /*==============================================================
                           ENDING INDEXPAGES
    ==============================================================*/




    /*==============================================================
                           BEGIN CANDIDATES
    ==============================================================*/
    public function indexCandidates($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.candidates.overview', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexCandidatesAddSingle($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);
      $selectedE = Election::where('uuid', $electionUUID)->firstOrFail()->id;

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.candidates.addC', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function candidatesAddSingleInsert(Request $request){

      $validatedData = $request->validate([
        'candidateName' => 'required|max:255',
        'candidateDescription' => 'required|max:255',
        'candidateLevel' => 'required|numeric',
        'candidateImage' => '',

      ]);

      if ($request->file('candidateImage')) {
         $imagePath = $request->file('candidateImage');
         $imageName = Str::uuid();

         $path = $request->file('candidateImage')->storeAs('uploads', $imageName, 'public');
       }

      $candidate = new Candidate;

      $candidate->name = $request->candidateName;
      $candidate->description = $request->candidateDescription;
      if(!empty($request->candidateImage)){
      $candidate->image = '/storage/'.$path;
      }
      $candidate->level = $request->candidateLevel;
      $candidate->uuid = Str::uuid();
      $candidate->election_id = Election::where('uuid', $request->electionUUID)->firstOrFail()->id;
      $candidate->type = $request->candidateType;

      $candidate->save();

      return redirect()->route('candidates.view', ['electionUUID' => $request->electionUUID]);

    }

    public function indexCandidatesAddMany($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.candidates.upload', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function candidatesAddMany(Request $request){
      $file = $request->file('candidateFile');

      $candidateArray = Self::csvToArray($file);

      for ($i = 0; $i < count($candidateArray); $i ++){
          Candidate::firstOrCreate($candidateArray[$i]);
      }

      return "TEST";
      }



    /*==============================================================
                           ENDING CANDIDATES
    ==============================================================*/







    /*==============================================================
                           BEGIN VOTERS
    ==============================================================*/
    public function indexVoters($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.overview', ['electionUUID' => $electionUUID],compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function indexVotersAddSingle($electionUUID){
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

      $validatedData = $request->validate([
        'voterName' => 'required|max:255',
        'voterSurname' => 'required|max:255',
        'voterDate' => 'required|date',
        'voterEmail' => 'required|email',
        'voterClass' => 'exists:App\Schoolclass,id',
        'voterForm' => 'required|numeric',

      ]);

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


    public function indexVotersAddMany($electionUUID){
      $user = Auth::user();
      $electionArray = Self::electionPermission($user);

      if($user->hasPermissionTo($electionUUID)){
        return view('backendviews.v2.voters.upload', ['electionUUID' => $electionUUID], compact('electionArray', 'user'));
      } else {
        return redirect()->route('unauthorized');
      }
    }

    public function votersAddMany(Request $request){

        $electionID = Election::where('uuid', $request->electionUUID)->firstOrFail()->id;


        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $request->votersFile->getClientOriginalName();
            $tempPath = $request->votersFile->getRealPath();
                    // Reading file
                    $file = fopen($tempPath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 5000, ";")) !== FALSE) {
                        $num = count($filedata );

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if($i == 0){
                           $i++;
                           continue;
                        }
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){

                        //Query holt sich den Jahrgang
                        $jahrgang  = Form::where('election_id', $electionID)->where('name', $importData[4])->first();

                        //Abfrage ob es einen Jahrgang gibt wenn nein wird ein neuer erstellt + der Voter wird diesem Jahrgang zugeordnet

                            if(empty($jahrgang)){

                                $formUUID=Str::uuid();
                                $form = new Form();
                                $form->name = $importData[4];
                                $form->election_id = $electionID;
                                $form->uuid = $formUUID;
                                $form->save();

                                $form_id = Form::where('uuid', $formUUID)->first()->id;

                            }


                        //Query holt sich die Klasse
                        $schoolclass  = Schoolclass::where('election_id', $electionID)->where('name', $importData[5])->first();

                        //Abfrage ob es einen Jahrgang gibt wenn nein wird ein neuer erstellt + der Voter wird diesem Jahrgang zugeordnet

                            if(empty($schoolclass)){


                                $class = new Schoolclass();
                                $class->name = $importData[5];
                                $class->election_id = $electionID;
                                $class->form_id = Form::where('uuid', $formUUID)->firstOrFail()->id;
                                $class->uuid = $schoolclassUUID=Str::uuid();
                                $class->save();


                            }

                        $v = new Voter();
                        $v->name = $importData[0];
                        $v->surname = $importData[1];
                        $v->birth_year = $importData[2];
                        $v->uuid = Str::uuid();
                        $v->direct_uuid = Str::uuid();
                        $v->email = $importData[3];
                        $v->election_id = $electionID;

                        if(!(empty($jahrgang))){
                            $v->form_id = $jahrgang->id;
                        } else {
                            $v->form_id = $form_id;
                        }

                        if(!(empty($schoolclass))){
                            $v->schoolclass_id = $schoolclass->id;
                        } else {
                            $v->schoolclass_id = $schoolclass_id = Schoolclass::where('uuid', $schoolclassUUID)->first()->id;
                        }



                        $v->save();
                    }


        }
        // Redirect to index
        return "Success";
    }

      /*==============================================================
                             ENDING VOTERS
      ==============================================================*/

    /*************************************************************
    *************************************************************
                         ENDING BACKENDPAGES
    *************************************************************
    **************************************************************/









    /*==============================================================
                           BEGIN PROFILE-BACKEND
    ==============================================================*/
    //Function that displays the Profilepage
    public function indexProfile(){
      $locations = config('countries');

      $user = Auth::user();
      $allPermissions = $user->getAllPermissions();

      return view('layouts.profile', compact('allPermissions'))->withLocations($locations)->withUser($user);
    }

    //Function that inserts the updated data
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

    //Function that deletes the profile
    public function deleteProfile(){

      $user = User::find(Auth::user()->id);

      $user->delete();

      return redirect('home');
    }

    /*==============================================================
                           ENDING PROFILEBACKEND
    ==============================================================*/




    /*==============================================================
                           BEGIN FUNCTION-SECTION
    ==============================================================*/
    //Lists all Elections that the user has permission for
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



    /*==============================================================
                           ENDING FUNCTION-SECTION
    ==============================================================*/


    /*==============================================================
                           BEGIN MIDDLEWARE-PAGES
    ==============================================================*/
    //Return the "unauthorizes-page"
    public function unauthorized(){
      return view('unauthorized');
    }
    /*==============================================================
                           ENDING MIDDLEWAREPAGES
    ==============================================================*/
}
