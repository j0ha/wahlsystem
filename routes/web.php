<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
Route::get('/testRoute/candidates/{electionUUID}', 'App\Http\Controllers\electionProcessController@querryElectionCandidates', ['electionUUID' => 'electionUUID']);

//ROUTES FOR TERMINAL
Route::group(['prefix' => 'vote'], function(){
  //STANDARD ROUTE
  Route::get('/{electionUUID}/{terminalUUID}', 'App\Http\Controllers\terminalController@verifyTerminalAcces', ['electionUUID' => 'electionUUID'], ['terminalUUID' => 'terminalUUID'])->name('vote');

  //DIRECT ROUTE
  Route::get('/{electionUUID}/{terminalUUID}/d/{dircetUUID}', 'App\Http\Controllers\terminalController@verifyTerminalAcces', ['electionUUID' => 'electionUUID'], ['terminalUUID' => 'terminalUUID'], ['directUUID' => 'directUUID'])->name('vote.direct');

  //TOKEN
  Route::get('/token', 'App\Http\Controllers\terminalController@verifyTerminalAcces')->name('vote.token');

});

//ROUTES FOR BACKEND
Route::group(['prefix' => 'dvi'], function() {
  Route::group(['prefix' => 'home'], function(){
    //Opens the electionBackend without any election selected
    Route::get('/', 'App\Http\Controllers\backendController@indexHomeWithoutElection')->name('home.without.election');
    //Election Dashboard
    Route::get('/{electionUUID}', 'App\Http\Controllers\backendController@indexDashboard')->name('election.Dashboard');
    //Opens the electionBackend with an election selected
    Route::get('/{electionUUID}/Informations', 'App\Http\Controllers\backendController@indexInformations')->name('election.Informations');
    //Show the stats of the actual electionUUID
    Route::get('/{electionUUID}/stats', 'App\Http\Controllers\backendController@indexElectionStats')->name('election.Stats');
    //All Voter to the elecetion
    Route::get('/{electionUUID}/voters', 'App\Http\Controllers\backendController@indexVoters')->name('voters.view');
    //Ein Datensatz kann hinzugefügt werden
    Route::get('/{electionUUID}/voters/add', 'App\Http\Controllers\backendController@votersAddSingle')->name('voters.add.single');
    Route::post('/electionVotersAddSingle', 'App\Http\Controllers\backendController@votersAddSingleInsert')->name('votersAddSingle');
    //Großer Datensatz inform von einer Datei
    Route::get('/{electionUUID}/voters/bulkadd', 'App\Http\Controllers\backendController@votersAddMany')->name('voters.add.many');
    //ROUTES DO NOT WORK AT THE MOMENT
    Route::get('/{electionUUID}/candidates', 'App\Http\Controllers\backendController@indexCandidates')->name('candidates.views');
    Route::get('/{electionUUID}/candidates/add', 'App\Http\Controllers\backendController@candidatesAddSingle')->name('candidates.add.single');
    Route::get('/{electionUUID}/candidates/bulkadd', 'App\Http\Controllers\backendController@candidatesAddMany')->name('candidates.add.many');
    //Alle Emails versenden, an die eingetragenen Emails, with options?
    Route::get('/{electionUUID}/bulkemail', 'App\Http\Controllers\backendController@bulkemail')->name('bulkemail');
  });
  //Routen zum erstellen einer neuen Wahl
  Route::get('/setup', 'App\Http\Controllers\createController@index')->name('create.new.election');
  Route::post('/setup', 'App\Http\Controllers\createController@insert');


  Route::group(['prefix' => 'profil'],  function() {
    //Lists up all of the data, some fields maybe changeable?
    Route::get('/data', 'App\Http\Controllers\backendController@indexProfile')->name('profile.Data')->middleware('auth');
    Route::post('/profileUpdate', 'App\Http\Controllers\backendController@updateProfile')->name('profile.Data.Update')->middleware('auth');
    Route::post('/profileDelete', 'App\Http\Controllers\backendController@deleteProfile')->name('profile.Data.DeleteProfile')->middleware('auth');
    //Open for everything
    Route::get('/', function(){return 'user profil setting site';});

  });
});


Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
});


Route::get('/ade', function () {
    return view('backendviews.v2.electioncontrolling');
});
