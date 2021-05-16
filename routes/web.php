<?php

use App\Mail\helperInvitation;
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

/*==============================================================
                           HOMEROUTE
    ==============================================================*/
Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');
Route::get('/impressum', '\App\Http\Controllers\HomeController@indexImpressum')->name('impressum');

/********************************************************************
                            BEGIN VOTING
 *********************************************************************/

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


/********************************************************************
                           BEGIN BACKEND
 *********************************************************************/

Route::group(['middleware' => ['auth', '2fa', 'verified']], function (){
Route::group(['prefix' => 'dvi'], function() {
  Route::group(['prefix' => 'home'], function(){
    /*==============================================================
                           BEGIN INDEXPAGES
    ==============================================================*/
    Route::get('/', 'App\Http\Controllers\backendController@indexHomeWithoutElection')->name('home.without.election');

    Route::get('/{electionUUID}', 'App\Http\Controllers\backendController@indexDashboard')->name('election.Dashboard');

    Route::get('/{electionUUID}/Informations', 'App\Http\Controllers\backendController@indexInformations')->name('election.Informations');

    Route::get('/{electionUUID}/ElectionHelper', 'App\Http\Controllers\backendController@indexWahlhelfer')->name('election.Helper');
    Route::post('/ElectionHelper', 'App\Http\Controllers\backendController@sendWahlhelfer')->name('electionHelper');

    Route::get('/{electionUUID}/schoolclass', 'App\Http\Controllers\backendController@indexSchoolclass')->name('election.schoolclasses.overview');


    Route::get('/{electionUUID}/schoolgrade', 'App\Http\Controllers\backendController@indexSchoolgrade')->name('election.schoolgrades.overview');

    Route::get('/{electionUUID}/controlling', 'App\Http\Controllers\backendController@indexControlling')->name('election.Controlling');

      /*==============================================================
                             BEGIN VOTERS ROUTES
      ==============================================================*/
      Route::get('/{electionUUID}/voters', 'App\Http\Controllers\backendController@indexVoters')->name('voters.view');

    /*==============================================================
                            Security Reporter ROUTES
    ==============================================================*/
    Route::group(['middleware' => 'admin'], function (){
    Route::get('/{electionUUID}/securityreporter', 'App\Http\Controllers\backendController@indexSecurityreporter')->name('election.securityreporter');
    });

    Route::group(['middleware' => 'ended'], function (){
    Route::get('/{electionUUID}/evaluation', 'App\Http\Controllers\backendController@indexEvaluation')->name('election.evaluation');
    });

    Route::get('/{electionUUID}/terminals', 'App\Http\Controllers\backendController@indexTerminals')->name('election.terminals.overview');

    Route::get('/{electionUUID}/stats', 'App\Http\Controllers\backendController@indexElectionStats')->name('election.Stats');

    Route::get('/{electionUUID}/voteractivator', 'App\Http\Controllers\backendController@indexVoteractivator')->name('election.voteractivator');

    Route::group(['middleware' => 'waiting'], function (){
    /*==============================================================
                           BEGIN VOTERS ROUTES
    ==============================================================*/
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
    /*==============================================================
                         PROFILE ROUTES
    ==============================================================*/

    Route::group(['prefix' => 'profil'],  function() {
        //Lists up all of the data, some fields maybe changeable?
        Route::get('/data', 'App\Http\Controllers\backendController@indexProfile')->name('profile.Data')->middleware(['auth', '2fa', 'verified']);
        Route::post('/profileUpdate', 'App\Http\Controllers\backendController@updateProfile')->name('profile.Data.Update')->middleware(['auth', '2fa', 'verified']);
        Route::post('/profileDelete', 'App\Http\Controllers\backendController@deleteProfile')->name('profile.Data.DeleteProfile')->middleware(['auth', '2fa', 'verified']);
        Route::post('/electionDelete', 'App\Http\Controllers\backendController@deleteElection')->name('profile.Data.DeleteElection')->middleware(['auth', '2fa', 'verified']);
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

/*==============================================================
                         AUTH ROUTES
  ==============================================================*/

Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes(['verify' => true]);
});

/*==============================================================
                         2FA ROUTES
  ==============================================================*/

Route::get('/complete-registration', 'App\Http\Controllers\Auth\RegisterController@completeRegistration')->name('complete.2fa');
Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');

/*==============================================================
                         BEGIN Electionhelper ROUTES
  ==============================================================*/

Route::group(['prefix' => 'invite'], function(){
    Route::get('/{token}', '\App\Http\Controllers\helperActivator@helperActivate')->name('invite.election');
    Route::post('/helpAccept', '\App\Http\Controllers\helperActivator@helpAccept')->name('helper.Accept');
    Route::post('/helpDecline', '\App\Http\Controllers\helperActivator@helpDecline')->name('helper.Decline');
});

/*==============================================================
                         UNAUTHORIZED ROUTES
  ==============================================================*/
Route::get('/escape', function () {
    return view('welcome');
})->name('escape');
