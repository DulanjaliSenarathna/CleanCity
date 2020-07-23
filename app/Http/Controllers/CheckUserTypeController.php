<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserTypeController extends Controller
{

    public function checkUserType(){

          if(Auth::user()->job == 'Admin'){
              return redirect()->route('dashboard');
          }
          else if(Auth::user()->job == 'Captain'){
              return redirect()->route('captainPage');
          }
          else if(Auth::user()->job == 'Staff'){
              return redirect()->route('staffPage');
          }
          else if(Auth::user()->job == 'Volunteer'){
              return redirect()->route('volunteerPage');
          }
          else if(Auth::user()->job == 'blocked'){
              return redirect()->route('blocked');
          }
        else{
          return redirect()->route('home');
        }
    }
}
