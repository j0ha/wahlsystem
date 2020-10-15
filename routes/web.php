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
Route::group(['prefix' => 'dvi'], function() {
    Route::group(['prefix' => 'home'], function(){
    Route::get('/', function(){return 'home without election';});
    Route::get('/{electionUUID}', function(){return 'home with election';});
    Route::get('/{electionUUID}/stats', function(){return 'stats';});
    Route::get('/{electionUUID}/baseinfo', function(){return 'basic infomations';});
    Route::get('/{electionUUID}/voters', function(){return 'voter overview';});
    Route::get('/{electionUUID}/voters/add', function(){return 'voters add';});
    Route::get('/{electionUUID}/voters/bulkadd', function(){return 'voters bulk add';});
    Route::get('/{electionUUID}/candidates', function(){return 'candidates overview';});
    Route::get('/{electionUUID}/candidates/add', function(){return 'candidates add';});
    Route::get('/{electionUUID}/candidates/bulkadd', function(){return 'candidates bulk add';});
    Route::get('/{electionUUID}/bulkemail', function(){return 'send bulk emails';});
  });
  Route::get('/setup', 'App\Http\Controllers\createController@index');
  Route::post('/setup', 'App\Http\Controllers\createController@insert');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('/multiform', App\Http\Livewire\Multiform::class);
Route::get('/multiform', 'App\Http\Controllers\createController@index');

Route::post('/electionInsert', 'App\Http\Controllers\createController@insert');

Route::get('/backend', function(){
  return view('layouts.backend');
});
