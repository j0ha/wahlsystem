<?php

namespace App\Http\Controllers;

use App\Mode;
use Illuminate\Http\Request;

class createController extends Controller
{
    public function __construct(){
      // TODO: Later middleware : AUTH
    }

    public function index(){
      return view('electionCreation');
    }

    public function insert(Request $request){

    }

}
