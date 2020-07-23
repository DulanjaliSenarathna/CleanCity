<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\post;
use App\citie;


class ProfileController extends Controller
{



    public function profile(){

      $id =Auth::user()->id;
      $name =Auth::user()->name;
      $title=$name;
      $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

      $post =DB::table('posts')->join('users','posts.user_id','=','users.id')->
      where(['user_id'=>$id])->orderBy('posts.postid', 'desc')->paginate(4);

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

      return view('admin.pages.profile',['profile'=>$profile,'post'=>$post,'title'=>$title,
      'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
    }




    public function addProfile(Request $request){
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'year'=>['required','numeric'],
        'month'=>['required','numeric'],
        'date'=>['required','numeric'],
        'gender'=>['required'],
        'city'=>['required'],
        'suburb'=>['required'],
       ]);

       $users = new users();
       $users->name = $request->input('name');
       $users->email = $request->input('email');
       $users->password = Hash::make($request['password']);
       $users->birthday = $request->input('year').'.'.$request->input('month').'.'.$request->input('date');
       $users->gender = $request->input('gender');
       $users->city = $request->input('city');
       $users->suburb = $request->input('suburb');
       $users->job = $request->input('job');
            if(Input::hasFile('profile_pic')){
                $file=Input::file('profile_pic');
                $file->move(public_path().'/uploads/',
                $file->getClientOriginalName());
                $url=URL::to("/").'/uploads/'.$file->getClientOriginalName();
                $users->profile_pic = $url;
            }else {
              $users->profile_pic = 'http://localhost/basicwebsite/public/uploads/default.jpg';
            }
       $users->save();
       return redirect('addmembers')->with('status', 'Profile Added Sucessfully');
    }






    public function updateProfile(Request $request){
      $id =Auth::user()->id;
      $this->validate($request, [
        'name' => ['string', 'max:255'],
        'city'=>['required'],
        'suburb'=>['required'],
       ]);

       $users = new users();
       $users->name = $request->input('name');
       $users->email = $request->input('email');
       $users->password = Hash::make($request['password']);
       $users->birthday = $request->input('year').'-'.$request->input('month').'-'.$request->input('date');
       $users->gender = $request->input('gender');
       $users->city = $request->input('city');
       $users->suburb = $request->input('suburb');
       $users->job = $request->input('job');
            if(Input::hasFile('profile_pic')){
                $file=Input::file('profile_pic');
                $file->move(public_path().'/uploads/',
                $file->getClientOriginalName());
                $url=URL::to("/").'/uploads/'.$file->getClientOriginalName();
                $users->profile_pic = $url;
            }
            else {
              $users->profile_pic = 'http://localhost/basicwebsite/public/uploads/default.jpg';
            }
            $data=array(
              'name' => $users->name,
              'gender'=>$users->gender,
              'birthday'=>$users->birthday,
              'city'=>$users->city,
              'suburb'=> $users->suburb,
            );
            users::where('id',$id)->update($data);
       $users->update();
       return redirect()->back()->with('status', 'Profile Update Sucessfully');
    }




    public function updatepassword(Request $request){
      $id =Auth::user()->id;
      $this->validate($request, [
        'password' => ['string', 'min:6', 'confirmed'],
       ]);
       $users = new users();
       $users->password = Hash::make($request['password']);
            $data=array(
              'password' => $users->password,
            );
            users::where('id',$id)->update($data);
            $users->update();
        return redirect()->back()->with('status2', 'Password Update Sucessfully');
    }





    public function updateProfilepicture(Request $request){
      $id =Auth::user()->id;
      $this->validate($request, [
        'profile_pic'=>['required'],
       ]);
       $users = new users();
       if(Input::hasFile('profile_pic')){
           $file=Input::file('profile_pic');
           $file->move(public_path().'/uploads/',
           $file->getClientOriginalName());
           $url=URL::to("/").'/uploads/'.$file->getClientOriginalName();
           $users->profile_pic = $url;
       }
            $data=array(
              'profile_pic' => $users->profile_pic,
            );
            users::where('id',$id)->update($data);
       $users->update();
        return redirect()->back()->with('status3', 'Profile Picture Update Sucessfully');
    }



    public function viewprofile($ids){

      $id =Auth::user()->id;
      $email = DB::table('users')->where(['id'=>$ids])->first()->email;
      $profile = DB::table('users')->where(['id'=>$id])->first();
      $user = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$ids])->first();
      $title=$user->name;

      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

      $location=DB::table('drop_locations')->where([['job_status','1'],['email',$email]])->get();

      return view('admin.pages.membersprofile',['profile'=>$profile,'user'=>$user,
      'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification,'location'=>$location]);
    }


    public function editprofile(){
          $title='Edit Profile';
          $id =Auth::user()->id;
          $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

          $messagecount=DB::table('messages')->where('read_or_not','0')->get();
          $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

          $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

          $cities = citie::all();

          return view('admin.pages.editprofile',['profile'=>$profile,'title'=>$title,
          'messagecount'=>$messagecount,'message'=>$message,'cities'=>$cities,'notification'=>$notification]);
        }



}
