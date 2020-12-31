<?php

use Illuminate\Support\Facades\Route;
use App\Mail\electionInvitation;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\securityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|$thing, $UUID, $electionUUID
*/
Route::get('home', '\App\Http\Controllers\HomeController@index');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/escape', function () {
    return view('welcome');
})->name('escape');

//TESTROUTE
Route::get('/testRoute/{thing}/{uuid}/{elctionUUID}', 'App\Http\Controllers\securityController@verifyToElection', ['thing' => 'thing'], ['uuid' => 'UUID'], ['electionUUID' => 'electionUUID']);
Route::get('/tesA/{voterUUID}', 'App\Http\Controllers\securityController@voteVerification', ['voterUUID' => 'voterUUID']);
Route::get('/testy', 'App\Http\Controllers\electiontypes\spv@getThem');



Route::get('/testRoute/candidates/{electionUUID}', 'App\Http\Controllers\electionProcessController@querryElectionCandidates', ['electionUUID' => 'electionUUID']);
Route::get('/testRoute/stat/{electionUUID}', 'App\Http\Controllers\statsController@schoolclassesVoteTurnout', ['electionUUID' => 'electionUUID']);
Route::get('/test/email/send', function(){
  Mail::to('taylor@example.com')->send(new electionInvitation('71c34c0b-1c7b-4396-a601-c0d1fa6b74eb'));
});
Route::get('/test/email', function(){
 $email = new \App\Http\Controllers\emailController('39dd732f-8e44-42a7-bdb3-96187f8c5846');
 $email->sendSingelInvation('164dbd5f-50ec-4ec9-ab05-24a5bf510d70', '196e6137-b5e2-4968-8d76-c42d40598e61');
});
Route::get('/test/view', function(){
 return view('vote.spv.schoolforms');
});

Route::get('/test/{userUUID}', 'App\Http\Controllers\paperController@downloadSingelInvitation', ['userUUID' => 'userUUID']);

//ROUTES FOR TERMINAL
Route::group(['prefix' => 'vote'], function(){
  //STANDARD ROUTE
  Route::get('/{electionUUID}/{terminalUUID}', function($electionUUID, $terminalUUID){
      $terminalController = new \App\Http\Controllers\terminalController($electionUUID);
      return $terminalController->index($terminalUUID, null);
  })->name('vote');

  //DIRECT ROUTE
  Route::get('/d/{electionUUID}/{terminalUUID}/{directUUID}', function($electionUUID, $terminalUUID, $directUUID){
      $terminalController = new \App\Http\Controllers\terminalController($electionUUID);
      return $terminalController->index($terminalUUID, $directUUID);
  })->name('vote.direct');

});

//ROUTES FOR BACKEND
Route::group(['middleware' => 'auth'], function (){
Route::group(['prefix' => 'dvi'], function() {
  Route::group(['prefix' => 'home'], function(){
    /*==============================================================
                           BEGIN INDEXPAGES
    ==============================================================*/
    Route::get('/', 'App\Http\Controllers\backendController@indexHomeWithoutElection')->name('home.without.election');
    //Election Dashboard
    Route::get('/{electionUUID}', 'App\Http\Controllers\backendController@indexDashboard')->name('election.Dashboard');
    //Opens the electionBackend with an election selected
    Route::get('/{electionUUID}/Informations', 'App\Http\Controllers\backendController@indexInformations')->name('election.Informations');


    Route::get('/{electionUUID}/schoolclass', 'App\Http\Controllers\backendController@indexSchoolclass')->name('election.schoolclasses.overview');


    Route::get('/{electionUUID}/schoolgrade', 'App\Http\Controllers\backendController@indexSchoolgrade')->name('election.schoolgrades.overview');

    Route::get('/{electionUUID}/controlling', 'App\Http\Controllers\backendController@indexControlling')->name('election.Controlling');

    Route::group(['middleware' => 'admin'], function (){
    Route::get('/{electionUUID}/securityreporter', 'App\Http\Controllers\backendController@indexSecurityreporter')->name('election.securityreporter');
    });

    Route::group(['middleware' => 'ended'], function (){
    Route::get('/{electionUUID}/evaluation', 'App\Http\Controllers\backendController@indexEvaluation')->name('election.evaluation');
    });

    Route::get('/{electionUUID}/terminals', 'App\Http\Controllers\backendController@indexTerminals')->name('election.terminals.overview');

    //Show the stats of the actual electionUUID
    Route::get('/{electionUUID}/stats', 'App\Http\Controllers\backendController@indexElectionStats')->name('election.Stats');

    Route::get('/{electionUUID}/voteractivator', 'App\Http\Controllers\backendController@indexVoteractivator')->name('election.voteractivator');

    Route::group(['middleware' => 'waiting'], function (){
    /*==============================================================
                           BEGIN VOTERS ROUTES
    ==============================================================*/
    Route::get('/{electionUUID}/voters', 'App\Http\Controllers\backendController@indexVoters')->name('voters.view');
    //Ein Datensatz kann hinzugefügt werden
    Route::get('/{electionUUID}/voters/add', 'App\Http\Controllers\backendController@indexVotersAddSingle')->name('voters.add.single');
    Route::post('/electionVotersAddSingle', 'App\Http\Controllers\backendController@votersAddSingleInsert')->name('votersAddSingle');
    //Großer Datensatz inform von einer Datei
    Route::get('/{electionUUID}/voters/bulkadd', 'App\Http\Controllers\backendController@indexVotersAddMany')->name('voters.add.many');
    Route::post('/electionVotersAddMany', 'App\Http\Controllers\backendController@votersAddMany')->name('votersAddMany');
    /*==============================================================
                           BEGIN CANDIDATES ROUTES
    ==============================================================*/
    Route::get('/{electionUUID}/candidates', 'App\Http\Controllers\backendController@indexCandidates')->name('candidates.view');

    Route::get('/{electionUUID}/candidates/add', 'App\Http\Controllers\backendController@indexCandidatesAddSingle')->name('candidates.add.single');
    Route::post('/electionCandidatesAddSingle', 'App\Http\Controllers\backendController@candidatesAddSingleInsert')->name('candidatesAddSingle');

    Route::get('/{electionUUID}/candidates/bulkadd', 'App\Http\Controllers\backendController@indexCandidatesAddMany')->name('candidates.add.many');
    Route::post('/electionCandidatesAddMany', 'App\Http\Controllers\backendController@candidatesAddMany')->name('candidatesAddMany');
    });
    /*==============================================================
                           EMAIL ROUTES
    ==============================================================*/
    Route::get('/{electionUUID}/bulkemail', 'App\Http\Controllers\backendController@bulkemail')->name('bulkemail');

    /*==============================================================
                           BEGIN DOWNLOAD ROUTES
    ==============================================================*/
    Route::group(['prefix' => 'downloads'], function(){
      Route::get('/singelInvitation/{voterUUID}/{electionUUID}', function($voterUUID, $electionUUID){
          $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
          return $papercontroler->downloadSingelInvitation($voterUUID);
      })->name('download.singelInvitation');
        Route::get('/evaluation/{electionUUID}', 'App\Http\Controllers\paperController@downloadEvaluation')->name('download.evaluation');
        Route::get('/terminals/{electionUUID}', function($electionUUID){
            $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
            return $papercontroler->downloadTerminals();
        })->name('download.terminals');
        Route::get('/voters/{electionUUID}', function($electionUUID){
            $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
            return $papercontroler->downloadVoters();
        })->name('download.voters');
        Route::get('/candidates/{electionUUID}', function($electionUUID){
            $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
            return $papercontroler->downloadCandidates();
        })->name('download.candidates');
        Route::get('/schoolclasses/{electionUUID}', function($electionUUID){
            $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
            return $papercontroler->downloadSchoolclasses();
        })->name('download.schoolclasses');
        Route::get('/forms/{electionUUID}', function($electionUUID){
            $papercontroler = new \App\Http\Controllers\paperController($electionUUID);
            return $papercontroler->downloadForms();
        })->name('download.forms');

    });
  });

    Route::group(['prefix' => 'profil'],  function() {
        //Lists up all of the data, some fields maybe changeable?
        Route::get('/data', 'App\Http\Controllers\backendController@indexProfile')->name('profile.Data')->middleware('auth');
        Route::post('/profileUpdate', 'App\Http\Controllers\backendController@updateProfile')->name('profile.Data.Update')->middleware('auth');
        Route::post('/profileDelete', 'App\Http\Controllers\backendController@deleteProfile')->name('profile.Data.DeleteProfile')->middleware('auth');
        //Open for everything
        Route::get('/', function(){return 'user profil setting site';});

    });
});
  /*==============================================================
                         BEGIN ELECTION CREATION ROUTES
  ==============================================================*/
  Route::get('/setup', 'App\Http\Controllers\createController@index')->name('create.new.election');
  Route::post('/setup', 'App\Http\Controllers\createController@insert');

  /*==============================================================
                         BEGIN PROFILE ROUTES
  ==============================================================*/

});

/*==============================================================
                         BEGIN Election-Controlling ROUTES
  ==============================================================*/

Route::post('/electionActivate', 'App\Http\Controllers\electionControlling@activate')->name('e.activate');
Route::post('/electionActivateWithTime', 'App\Http\Controllers\electionControlling@activateWithTime')->name('e.activateWithTime');
Route::post('/electionEnding', 'App\Http\Controllers\electionControlling@endElection')->name('e.end');
Route::post('/electionEmail', 'App\Http\Controllers\electionControlling@sendEmails')->name('e.email');
Route::post('/electionPlanEmail', 'App\Http\Controllers\electionControlling@planEmail')->name('e.planEmail');


Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
});


Route::get('/ade', function () {
    return view('backendviews.v2.electioncontrolling');
});
