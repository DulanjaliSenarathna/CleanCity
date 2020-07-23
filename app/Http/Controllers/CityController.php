<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\citie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\post;

class CityController extends Controller
{
  public function addcities(){
    $title='Add Cities';
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();
    $citys=DB::table('cities')->join('users','users.city','=','cities.city_id')->paginate(10);
    $citycount=DB::table('cities')->count();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $cityMemberCount = DB::table('users')->join('cities','cities.city_id','users.city')->where('users.city','cities.city_id')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.addcities',['profile'=>$profile,'citys'=>$citys,
    'citycount'=>$citycount,'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,
    'cityMemberCount'=>$cityMemberCount,'notification'=>$notification]);
  }


  public function addcity(Request $request){
    $this->validate($request, [
      'city' => ['required','max:100','unique:cities,city'],
     ]);
     $cities = new citie();
     $cities->city = $request->input('city');
     $cities->save();
     return redirect('addcities')->with('status', 'City Added Sucessfully');

  }
}
