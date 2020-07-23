<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Exceptions;

class PostController extends Controller
{


  public function postarticle(){
    $title='Post Article';
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

  return view('admin.pages.postarticle',['profile'=>$profile,'title'=>$title,
  'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }



    public function addPost(Request $request){
      $this->validate($request, [
        'post_title' => ['required', 'max:255'],
        'post_image'=>['required'],
        'category'=>['required'],
        'post_body'=>['required'],
       ]);

       $id =Auth::user()->id;
       $posts = new post();
       $posts->user_id = $id;
       $posts->post_title = $request->input('post_title');
       $posts->category = $request->input('category');
            if(Input::hasFile('post_image')){
                $file=Input::file('post_image');
                $file->move(public_path().'/uploads/posts',
                $file->getClientOriginalName());
                $url=URL::to("/").'/uploads/posts/'.$file->getClientOriginalName();
                $posts->post_image = $url;
            }
            $posts->post_body = $request->input('post_body');
       $posts->save();
       return redirect('profile')->with('status', 'Post Added Sucessfully');

    }

    public function updatepost(Request $request,$post_id){
      $this->validate($request, [
        'post_title' => ['required', 'max:255'],
        'post_image'=>['required'],
        'category'=>['required'],
        'post_body'=>['required'],
       ]);

       $id =Auth::user()->id;
       $posts = new post();
       $posts->user_id = $id;
       $posts->post_title = $request->input('post_title');
       $posts->category = $request->input('category');
            if(Input::hasFile('post_image')){
                $file=Input::file('post_image');
                $file->move(public_path().'/uploads/posts',
                $file->getClientOriginalName());
                $url=URL::to("/").'/uploads/posts/'.$file->getClientOriginalName();
                $posts->post_image = $url;
            }
            $posts->post_body = $request->input('post_body');
       $posts->update->where('postid',$post_id);
       return redirect('profile')->with('status', 'Post Added Sucessfully');

    }
}
