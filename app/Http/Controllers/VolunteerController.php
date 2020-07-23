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

class VolunteerController extends Controller
{
  public function volunteerprofile(){

    $id =Auth::user()->id;
    $email =Auth::user()->email;
    $name =Auth::user()->name;
    $title=$name;
    $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();




    $location=DB::table('drop_locations')->where([['job_status','1'],['email',$email]])->get();

    return view('volunteer/volunteerprofile',['profile'=>$profile,'title'=>$title,
    'location'=>$location]);
  }

      public function Submit(){
          $title='Submit Location';

          $data = DB::table('users')->count();
          $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
          $id =Auth::user()->id;
          $profile = DB::table('users')->where(['id'=>$id])->first();
          $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
          $messagecount=DB::table('messages')->where('read_or_not','0')->get();
          $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

          $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

        return view('volunteer/Submit',['users'=>$data,'members'=>$members,
          'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
          'message'=>$message,'notification'=>$notification]);
        }

        public function saveLocation(Request $request){
            $title='saveLocation';

            $this->validate($request, [
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255'],
              'title'=>['required'],
              'city'=>['required'],
              'level'=>['required'],
              'description'=>['required'],
              'lat'=>['required'],
              'lng'=>['required'],
             ]);

             $location = new drop_location();
             $location->name = $request->input('name');
             $location->email = $request->input('email');
             $location->title = $request->input('title');
             $location->city = $request->input('city');
             $location->level = $request->input('level');
             $location->description = $request->input('description');
             $location->lat = $request->input('lat');
             $location->lng = $request->input('lng');
                  if(Input::hasFile('image_url')){
                      $file=Input::file('image_url');
                      $file->move(public_path().'/uploads/volunteer/',
                      $file->getClientOriginalName());
                      $url=URL::to("/").'/uploads/volunteer/'.$file->getClientOriginalName();
                      $location->image_url= $url;
                  }else {
                    $location->image_url = 'http://127.0.0.1:8000/uploads/volunteer/noimage.png';
                  }
             $location->save();
             return redirect('SubmitedLocationList')->with('status', 'Location Added Sucessfully');
          }



          public function SubmitedLocationList(){
              $title='Submited Locations List';

              $data = DB::table('users')->count();
              $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
              $id =Auth::user()->id;
              $profile = DB::table('users')->where(['id'=>$id])->first();
              $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
              $messagecount=DB::table('messages')->where('read_or_not','0')->get();
              $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

              $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

              $location=DB::table('drop_locations')->orderby('id','desc')->get();

            return view('volunteer/Location_List',['users'=>$data,'members'=>$members,
              'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
              'message'=>$message,'notification'=>$notification,'location'=>$location]);
            }

            public function deletelocation($id){
              return $id;
                DB::table('drop_locations')->where('id', $id)->delete();
                return redirect()->back()->with('status', 'Location Delete Sucessfully');
            }

            public function AllSubmitedLocationList(){
                $title='All Submited Locations';

                $data = DB::table('users')->count();
                $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
                $id =Auth::user()->id;
                $profile = DB::table('users')->where(['id'=>$id])->first();
                $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
                $messagecount=DB::table('messages')->where('read_or_not','0')->get();
                $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

                $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

                $location=DB::table('drop_locations')->where('job_status','0')->get();

              return view('volunteer/AllSubmitedLocationList',['users'=>$data,'members'=>$members,
                'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
                'message'=>$message,'notification'=>$notification,'location'=>$location]);
              }

              public function viewlocation($ids){
                  $title='Submited Location';

                  $data = DB::table('users')->count();
                  $id =Auth::user()->id;
                  $profile = DB::table('users')->where(['id'=>$id])->first();

                  $location=DB::table('drop_locations')->where(['id'=>$ids])->first();

                return view('volunteer/ViewSubmitLocations',['users'=>$data,
                  'profile'=>$profile,'title'=>$title,'location'=>$location]);
                }



                public function volunteereditprofile(){
                      $title='Edit Profile';
                      $id =Auth::user()->id;
                      $profile = DB::table('users')->join('cities','users.city','=','cities.city_id')->where(['id'=>$id])->first();

                      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
                      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

                      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

                      $cities = citie::all();


                      return view('volunteer/volunteereditprofile',['profile'=>$profile,'title'=>$title,
                      'messagecount'=>$messagecount,'message'=>$message,'cities'=>$cities,'notification'=>$notification]);
                    }

                    public function CompletedLocationList(){
                      $title='Completed Locations';

                      $data = DB::table('users')->count();
                      $members = DB::table('users')->orderBy('id', 'desc')->paginate(8);
                      $id =Auth::user()->id;
                      $profile = DB::table('users')->where(['id'=>$id])->first();
                      $post =DB::table('posts')->orderBy('postid', 'desc')->paginate(4);
                      $messagecount=DB::table('messages')->where('read_or_not','0')->get();
                      $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

                      $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

                      $location=DB::table('drop_locations')->where('job_status','1')->get();

                    return view('volunteer/CompletedLocationList',['users'=>$data,'members'=>$members,
                      'profile'=>$profile,'title'=>$title,'post'=>$post,'messagecount'=>$messagecount,
                      'message'=>$message,'notification'=>$notification,'location'=>$location]);
                        }


}
