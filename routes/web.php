<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

Route::get('/', function () {
    return view('welcome');
});

//TESTROUTE
Route::get('/testRoute/{thing}/{uuid}/{elctionUUID}', 'App\Http\Controllers\securityController@verifyToElection', ['thing' => 'thing'], ['uuid' => 'UUID'], ['electionUUID' => 'electionUUID']);
Route::get('/tesA/{voterUUID}', 'App\Http\Controllers\securityController@voteVerification', ['voterUUID' => 'voterUUID']);
Route::get('/testRoute/d', function(){
  $securityController = new securityController;
  $re = $securityController->verifyToElection('form', 'bbab8a77-1494-48b8-a78b-12b1ee177434', '28deb7de-b978-4a51-a960-e34553729abd');
  return $re;
});
Route::get('/testy', 'App\Http\Controllers\electiontypes\spv@getThem');



Route::get('/testRoute/candidates/{electionUUID}', 'App\Http\Controllers\electionProcessController@querryElectionCandidates', ['electionUUID' => 'electionUUID']);
Route::get('/testRoute/stat/{electionUUID}', 'App\Http\Controllers\statsController@schoolclassesVoteTurnout', ['electionUUID' => 'electionUUID']);
Route::get('/test/email/send', function(){
  Mail::to('taylor@example.com')->send(new electionInvitation('71c34c0b-1c7b-4396-a601-c0d1fa6b74eb'));
});
Route::get('/test/email', function(){
 return new electionInvitation('71c34c0b-1c7b-4396-a601-c0d1fa6b74eb');
});
Route::get('/test/view', function(){
 return view('vote.spv.schoolforms');
});

Route::get('/test/{userUUID}', 'App\Http\Controllers\paperController@downloadSingelInvitation', ['userUUID' => 'userUUID']);

//ROUTES FOR TERMINAL
Route::group(['prefix' => 'vote'], function(){
  //STANDARD ROUTE
  Route::get('/{electionUUID}/{terminalUUID}', 'App\Http\Controllers\terminalController@index')->name('vote');

  //DIRECT ROUTE
  Route::get('/d/{electionUUID}/{terminalUUID}', 'App\Http\Controllers\terminalController@verifyTerminalAcces', ['electionUUID' => 'electionUUID'], ['terminalUUID' => 'terminalUUID'])->name('vote.direct');

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

    Route::get('/{electionUUID}/securityreporter', 'App\Http\Controllers\backendController@indexSecurityreporter')->name('election.securityreporter');

    Route::get('/{electionUUID}/evaluation', 'App\Http\Controllers\backendController@indexEvaluation')->name('election.evaluation');

    Route::get('/{electionUUID}/terminals', 'App\Http\Controllers\backendController@indexTerminals')->name('election.terminals.overview');

    //Show the stats of the actual electionUUID
    Route::get('/{electionUUID}/stats', 'App\Http\Controllers\backendController@indexElectionStats')->name('election.Stats');
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
    /*==============================================================
                           EMAIL ROUTES
    ==============================================================*/
    Route::get('/{electionUUID}/bulkemail', 'App\Http\Controllers\backendController@bulkemail')->name('bulkemail');

    /*==============================================================
                           BEGIN DOWNLOAD ROUTES
    ==============================================================*/
    Route::group(['prefix' => 'downloads'], function(){
      Route::get('/singelInvitation/{voterUUID}', 'App\Http\Controllers\paperController@downloadSingelInvitation', ['voterUUID' => 'voterUUID'])->name('download.singelInvitation');
        Route::get('/evaluation/{electionUUID}', 'App\Http\Controllers\paperController@downloadEvaluation')->name('download.evaluation');

    });
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
                         BEGIN Election-Controlling ROUTES
  ==============================================================*/

Route::post('/electionActivate', 'App\Http\Controllers\electionControlling@activate')->name('e.activate');
Route::post('/electionActivateWithTime', 'App\Http\Controllers\electionControlling@activateWithTime')->name('e.activateWithTime');
Route::post('/electionEnding', 'App\Http\Controllers\electionControlling@endElection')->name('e.end');


Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
});


Route::get('/ade', function () {
    return view('backendviews.v2.electioncontrolling');
});
