<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\post;
use App\newsletter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Exceptions;

class BlogController extends Controller
{


  public function index(){
    $title='Colombo Municipal Council Smart Cleaning Service';
    $posts =DB::table('posts')->orderBy('posts.postid', 'desc')->paginate(4);
    $slider =DB::table('posts')->orderBy('posts.postid', 'desc')->get();
    $footer =DB::table('posts')->orderBy('postid', 'desc')->paginate(12);
    return view('blog.index',['posts'=>$posts,'slider'=>$slider,'title'=>$title,'footer'=>$footer]);
  }

  

  public function viewpost($post_id){

    $post =DB::table('posts')->join('users','posts.user_id','=','users.id')->where(['posts.postid'=>$post_id])->get();
    $posts =DB::table('posts')->orderBy('posts.postid', 'desc')->paginate(4);
    $title='View Post';
    $footer =DB::table('posts')->orderBy('postid', 'desc')->paginate(12);
    return view('blog.post',['post'=>$post,'title'=>$title,'posts'=>$posts,'footer'=>$footer]);
  }

  public function deletepost($post_id){
    DB::table('posts')->where('postid', $post_id)->delete();
    return redirect()->back()->with('status', 'Post Delete Sucessfully');
  }

  public function editpost($post_id){
    $title='Edit Post';
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();
    $editpost=DB::table('posts')->where('postid', $post_id)->first();
    return view('admin.pages.editpostarticle',['profile'=>$profile,'editprofile'=>$editpost,'title'=>$title]);
  }

  public function Newsletter(Request $request){
    $this->validate($request, [
      'email' => ['required', 'string', 'email', 'max:255', 'unique:newsletters,email'],
     ]);
     $newsletter = new newsletter();
     $newsletter->email = $request->input('email');
     $newsletter->save();
     return redirect()->back()->with('status', 'Newsletter Subscribe Sucessfully');

  }

  public function spots(){


    $title='Garbage Spots';
    $footer =DB::table('posts')->orderBy('postid', 'desc')->paginate(12);

    $location=DB::table('spots')->get();


    return view('blog.GarbageSpots',['title'=>$title,'footer'=>$footer,'location'=>$location]);
  }




}
