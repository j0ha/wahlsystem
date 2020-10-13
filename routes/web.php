<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ElectionRegisteredMail;


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
Route::get('/testRoute/{thing}/{uuid}/{elctionUUID}', 'securityController@verifyToElection', ['thing' => 'thing'], ['uuid' => 'UUID'], ['electionUUID' => 'electionUUID']);

//ROUTE FOR TERMINAL

Route::get('/election/vote/{electionUUID}/{terminalUUID}', 'terminalController@verifyTerminalAcces', ['electionUUID' => 'electionUUID'], ['terminalUUID' => 'terminalUUID']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tokenTest', 'electiontypes\token@index')->name('Election Creation');

Route::post('/tokenInsert', 'electiontypes\token@insert');

Route::get('/token', function (){
  return view('mails/token');
});

Route::get('/email', function() {

  Mail::to('email@email.com')->send(new ElectionRegisteredMail());

  return new ElectionRegisteredMail();
});

Route::get('/invoice', function() {
  $pdf = PDF::loadView('invoice');
  return $pdf->download('invoice.pdf');
});
