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

class CaptainController extends Controller
{

    public function captainprofile(){

      $id =Auth::user()->id;
      $name =Auth::user()->name;
      $title=$name;
      $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

      $post =DB::table('posts')->join('users','posts.user_id','=','users.id')->
      where(['user_id'=>$id])->orderBy('posts.postid', 'desc')->paginate(4);

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

      return view('captain/captainprofile',['profile'=>$profile,'post'=>$post,'title'=>$title,
      'messagecount'=>$messagecount,'message'=>$message]);
    }

    public function captainpostarticle(){

      $title='Post Article';
      $id =Auth::user()->id;
      $profile = DB::table('users')->where(['id'=>$id])->first();

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('captain/postarticle',['profile'=>$profile,'title'=>$title,
    'messagecount'=>$messagecount,'message'=>$message]);
    }



    public function captaineditprofile(){

      $title='Edit Profile';
      $id =Auth::user()->id;
      $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

      $cities = citie::all();

      return view('captain/captaineditprofile',['profile'=>$profile,'title'=>$title,
      'messagecount'=>$messagecount,'message'=>$message,'cities'=>$cities,'notification'=>$notification]);
    }

    public function CaptainAllSubmitedLocationList(){
        $title='All Submited Locations';

        $data = DB::table('users')->count();
        $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
        $id =Auth::user()->id;
        $profile = DB::table('users')->where(['id'=>$id])->first();
        $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
        $messagecount=DB::table('messages')->where('read_or_not','0')->get();
        $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

        $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

        $location=DB::table('drop_locations')->orderBy('id', 'desc')->get();

      return view('captain/Added_Location_List',['users'=>$data,'members'=>$members,
        'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
        'message'=>$message,'notification'=>$notification,'location'=>$location]);
      }



        public function viewlocationcaptain($ids){
            $title='Submited Location';

            $data = DB::table('users')->count();
            $id =Auth::user()->id;
            $profile = DB::table('users')->where(['id'=>$id])->first();

            $location=DB::table('drop_locations')->where(['id'=>$ids])->first();

          return view('captain/ViewSubmitLocations',['users'=>$data,
            'profile'=>$profile,'title'=>$title,'location'=>$location]);
          }

          public function deletelocation($id){
              DB::table('drop_locations')->where('id', $id)->delete();
              return redirect()->back()->with('status', 'Location Delete Sucessfully');
          }

          public function deletelocationcaptainRedirectAllLocation($id){
              DB::table('drop_locations')->where('id', $id)->delete();
              return redirect('CaptainAllSubmitedLocationList')->with('status', 'Location Delete Sucessfully');
          }


            public function Verifiedlocationcaptain($id){
              $task=drop_location::find($id);
              $task->verified_status='1';
              $task->save();
              return redirect()->back()->with('status', 'Location Verified Sucessfully');
            }

            public function NotVerifiedlocationcaptain($id){
              $task=drop_location::find($id);
              $task->verified_status='0';
              $task->save();
              return redirect()->back()->with('status', 'Location Not Verified Sucessfully');
            }

            public function changeleveltolow($id){
              $task=drop_location::find($id);
              $task->level='low';
              $task->save();
              return redirect()->back()->with('status', 'Level Change To Low');
            }

            public function changeleveltomedium($id){
              $task=drop_location::find($id);
              $task->level='medium';
              $task->save();
              return redirect()->back()->with('status', 'Level Change To Medium');
            }

            public function changeleveltohigh($id){
              $task=drop_location::find($id);
              $task->level='high';
              $task->save();
              return redirect()->back()->with('status', 'Level Change To High');
            }

            public function pendingtoapprove(){
                $title='Pendign To Approve';

                $data = DB::table('users')->count();
                $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
                $id =Auth::user()->id;
                $profile = DB::table('users')->where(['id'=>$id])->first();
                $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
                $messagecount=DB::table('messages')->where('read_or_not','0')->get();
                $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

                $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

                $location=DB::table('drop_locations')->where('verified_status','0')->orderBy('id', 'desc')->get();

              return view('captain/pendingtoapprove',['users'=>$data,'members'=>$members,
                'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
                'message'=>$message,'notification'=>$notification,'location'=>$location]);
              }

}
