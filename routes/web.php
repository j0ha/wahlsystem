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
|
*/

Route::get('/', function () {
    return view('welcome');
});
//TESTROUTE
Route::get('/testRoute', 'testController@querryTerminal');

//ROUTE FOR TERMINAL

Route::get('/election/vote/{electionUUID}/{terminalUUID}', 'terminalController@verifyTruthiness', ['electionUUID' => 'electionUUID'], ['terminalUUID' => 'terminalUUID']);
