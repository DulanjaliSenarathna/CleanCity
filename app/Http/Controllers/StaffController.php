<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use DB;
use App\users;
use App\post;
use App\citie;
use App\drop_location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Exceptions;

class StaffController extends Controller
{



    public function getStaffView(){
      $id =Auth::user()->id;
      $name =Auth::user()->name;
      $title=$name;
      $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

      $post =DB::table('posts')->join('users','posts.user_id','=','users.id')->
      where(['user_id'=>$id])->orderBy('posts.postid', 'desc')->paginate(4);

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

      return view('staff/staffprofile',['profile'=>$profile,'post'=>$post,'title'=>$title,
      'messagecount'=>$messagecount,'message'=>$message]);
    }


    public function staffAllSubmitedLocationList(){
        $title='All Submited Locations';

        $data = DB::table('users')->count();
        $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
        $id =Auth::user()->id;
        $profile = DB::table('users')->where(['id'=>$id])->first();
        $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
        $messagecount=DB::table('messages')->where('read_or_not','0')->get();
        $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

        $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

        $location=DB::table('drop_locations')->where('verified_status','1')->orderBy('id', 'desc')->get();

      return view('staff/Added_Location_List',['users'=>$data,'members'=>$members,
        'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
        'message'=>$message,'notification'=>$notification,'location'=>$location]);
      }

      public function markascompletejon($id){
        $task=drop_location::find($id);
        $task->job_status='1';
        $task->save();
        return redirect()->back()->with('status', 'Completed Job Mark Sucessfully');
      }

      public function markasnotcompletejon($id){
        $task=drop_location::find($id);
        $task->job_status='1';
        $task->save();
        return redirect()->back()->with('status', 'Not Completed Completed Job Mark Sucessfully');
      }


      public function staffditprofile(){

        $title='Edit Profile';
        $id =Auth::user()->id;
        $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

        $messagecount=DB::table('messages')->where('read_or_not','0')->get();
        $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

        $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

        $cities = citie::all();

        return view('staff/staffeditprofile',['profile'=>$profile,'title'=>$title,
        'messagecount'=>$messagecount,'message'=>$message,'cities'=>$cities,'notification'=>$notification]);
      }

}
