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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('/multiform', App\Http\Livewire\Multiform::class);
Route::get('/multiform', 'App\Http\Controllers\createController@index');

Route::post('/electionInsert', 'createController@insert');

Route::get('/backend', function(){
  return view('layouts.backend');
});
