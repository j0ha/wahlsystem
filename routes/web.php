<?php

use Illuminate\Support\Facades\Route;

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
// Route::group(['prefix' => 'dvi'], function() {
//   Route::group(['prefix' => 'home'], function(){
//     Route::get('/', 'App\Http\Controllers\backendController@homewithoutelection')->name('homeWE');
//     Route::get('/{electionUUID}', 'App\Http\Controllers\backendController@home')->name('homeE');
//     //Everything with stats
//     Route::get('/{electionUUID}/stats', 'App\Http\Controllers\backendController@stats')->name('stats');
//     //All Voter to the elecetion
//     Route::get('/{electionUUID}/voters', 'App\Http\Controllers\backendController@voter')->name('voters');
//     //Ein Datensatz kann hinzugefügt werden
//     Route::get('/{electionUUID}/voters/add', 'App\Http\Controllers\backendController@voteradd')->name('addingvoters');
//     //Großer Datensatz inform von einer Datei
//     Route::get('/{electionUUID}/voters/bulkadd', 'App\Http\Controllers\backendController@bulkaddV')->name('addingbulk');
//     Route::get('/{electionUUID}/candidates', 'App\Http\Controllers\backendController@candidates')->name('candidates');
//     Route::get('/{electionUUID}/candidates/add', 'App\Http\Controllers\backendController@candidateadd')->name('addingcandidates');
//     Route::get('/{electionUUID}/candidates/bulkadd', 'App\Http\Controllers\backendController@candidatebulk')->name('candidatesbulkadding');
//     //Alle Emails versenden, an die eingetragenen Emails, with options?
//     Route::get('/{electionUUID}/bulkemail', 'App\Http\Controllers\backendController@bulkemail')->name('bulkemail');
//   });
//   Route::get('/setup', 'App\Http\Controllers\createController@index')->name('creElec');
//   Route::post('/setup', 'App\Http\Controllers\createController@insert');
//
//
//   Route::group(['prefix' => 'profil'],  function() {
//     //Lists up all of the data, some fields maybe changeable?
//     Route::get('/pdata', 'App\Http\Controllers\backendController@pdata')->name('profileData')->middleware('auth');
//     Route::post('/update', 'App\Http\Controllers\backendController@updatepData')->name('updateProfile')->middleware('auth');
//     Route::post('/deleteAccount', 'App\Http\Controllers\backendController@deleteAcc')->name('deleteAccount')->middleware('auth');
//     //Open for everything
//     Route::get('/', function(){return 'user profil setting site';});
//
//   });
// });


Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
});


Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/profile', function(){
  return view('layouts.profile');
});


//Backend new

Route::get('/ade', function(){
  return view('layouts.backend_v2');
});
