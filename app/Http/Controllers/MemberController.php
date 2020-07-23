<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use DB;
use Auth;
use App\citie;

class MemberController extends Controller
{
  public function index(){
    $title='Members';
     // $members=users::paginate(10);
     $members=DB::table('users')->join('cities','users.city','=','cities.city_id')->paginate(10);
     $id =Auth::user()->id;
     $profile = DB::table('users')->where(['id'=>$id])->first();

     $messagecount=DB::table('messages')->where('read_or_not','0')->get();
     $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

     $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

     return view('admin.pages.members',['members'=>$members,'profile'=>$profile,
     'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function addmembers(){
    $title='Add Member';
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $members = DB::table('users')->orderBy('id', 'desc')->paginate(16);

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    $cities = citie::all();

    return view('admin.pages.addmember',['profile'=>$profile,'members'=>$members,
    'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,
    'cities'=>$cities,'notification'=>$notification]);
  }



  public function changejobtocaptain($id){
    $task=users::find($id);
    $task->job='Captain';
    $task->save();
    return redirect()->back();
  }
  public function changejobtovolunteer($id){
    $task=users::find($id);
    $task->job='Volunteer';
    $task->save();
    return redirect()->back();
  }
  public function changejobtostaff($id){
    $task=users::find($id);
    $task->job='Staff';
    $task->save();
    return redirect()->back();
  }


  public function block($id){
    $task=users::find($id);
    $task->job='blocked';
    $task->save();
    return redirect()->back();
  }
  public function unblock($id){
    $task=users::find($id);
    $task->job='unblocked';
    $task->save();
    return redirect()->back();
  }

  public function deleteprofile($id){
    DB::table('users')->where('id', $id)->delete();
    return redirect()->back();

  }




}
