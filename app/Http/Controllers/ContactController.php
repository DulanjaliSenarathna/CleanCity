<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use App\users;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\post;
use App\message;

class ContactController extends Controller
{

  public function contactView(){
    $title='Contact Us';
    $footer =DB::table('posts')->orderBy('postid', 'desc')->paginate(12);
    return view('blog.contact',['title'=>$title,'footer'=>$footer]);
  }

  public function contactSave(Request $request){
    $this->validate($request, [
      'name' => ['max:100','required'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'subject'=>['required'],
      'message'=>['required'],
     ]);

     $msg = new message();
     $msg->name = $request->input('name');
     $msg->email = $request->input('email');
     $msg->subject = $request->input('subject');
     $msg->message = $request->input('message');
     $msg->save();
     // return redirect('addmembers')->with('status', 'Profile Added Sucessfully');
     return redirect()->back()->with('status', 'Your Message Send Sucessfully');
  }

  public function messagesview(){
    $title='Messages';

    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();
    $messagesview=DB::table('messages')->orderby('id','desc')->paginate(10);

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.messages',['profile'=>$profile,'title'=>$title,
    'messagecount'=>$messagecount,'message'=>$message,'messagesview'=>$messagesview,'notification'=>$notification]);
  }

  public function markAsUnread($id){
    $task=message::find($id);
    $task->read_or_not=0;
    $task->save();
    return redirect()->back();
  }
  public function markAsRead($id){
    $task=message::find($id);
    $task->read_or_not=1;
    $task->save();
    return redirect()->back();
  }


}
