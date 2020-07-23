<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\users;
use Auth;
use App\drop_location;

class LocationController extends Controller
{
  public function droplocation(){
    $title='Drop Locations';
    $data = DB::table('users')->count();
    $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.droplocation',['users'=>$data,'members'=>$members,'profile'=>$profile,
    'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);

  }


  public function save(Request $request){
    $this->validate($request, [
      'name' => ['required', 'max:255'],
      'address'=>['required'],
      'city'=>['required'],
     ]);

     $location = new drop_location();
     $location->name = $request->name;
     $location->address = $request->address;
     $location->city = $request->city;
     $location->lat = $request->lat;
     $location->lng = $request->lng;
     $location->save();

      return redirect()->back()->with('status', 'Post Added Sucessfully');
  }



  public function droplocationlist(){
    $locations=DB::table('drop_locations')->paginate(10);
    $title='Drop Locations List';
    $data = DB::table('users')->count();
    $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.droplocationlist',['users'=>$data,'members'=>$members,'profile'=>$profile,
    'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,'locations'=>$locations,'notification'=>$notification]);

  }

  public function deletelocation($id){
    DB::table('drop_locations')->where('id', $id)->delete();
    return redirect()->back();
  }
}
