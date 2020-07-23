<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\notification;

class NotificationController extends Controller
{
    public function getblockedView(){
        return view('blocked');
    }

    public function request(Request $request){
      $this->validate($request, [
        'email' => ['required', 'string', 'email', 'max:255'],
        'message' => ['required', 'string', 'max:255'],
       ]);

       $data = new notification();
       $data->email = $request->input('email');
       $data->message = $request->input('message');
       $data->type ='blockd';
       $data->save();

      return redirect()->back()->with('status', 'Request Send Sucessfully');
    }

}
