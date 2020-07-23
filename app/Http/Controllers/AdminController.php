<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\users;
use App\spot;
use Auth;
use App\citie;

class AdminController extends Controller
{
    public function dashboard(){
      $title='Dashboard';

      $data = DB::table('users')->count();
      $PendintoCleane = DB::table('drop_locations')->where('job_status', '0')->count();
      $PendintoApprove = DB::table('drop_locations')->where('verified_status', '0')->count();
      $TotalCleanePoint = DB::table('drop_locations')->where('job_status', '1')->count();
      $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
      $id =Auth::user()->id;
      $profile = DB::table('users')->where(['id'=>$id])->first();
      $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();
      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();
      $cities = citie::all();
      $location=DB::table('drop_locations')->where('job_status','0')->get();

    return view('admin.Dashboard',['users'=>$data,'PendintoCleane'=>$PendintoCleane,
    'PendintoApprove'=>$PendintoApprove,'TotalCleanePoint'=>$TotalCleanePoint,'members'=>$members,
      'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,'message'=>$message,
      'notification'=>$notification,'cities'=>$cities,'location'=>$location]);
    }

    public function savespot(Request $request){
      $this->validate($request, [
        'lat' => ['required', 'string'],
        'lng' => ['required', 'string'],
       ]);

       $spot = new spot();
       $spot->lat = $request->input('lat');
        $spot->lng = $request->input('lng');
       $spot->save();
       return redirect()->back()->with('status', 'Garbage Spot Added Sucessfully');

    }
}
