<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\citie;
use App\mails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\post;

class MailController extends Controller
{
  public function compose(){
    $title='Compose Mail';
    $id =Auth::user()->id;
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->orderby('id','desc')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.mailbox.Compose',['profile'=>$profile,
    'title'=>$title,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function sentbox(){
    $title='Sent Mail';
    $id =Auth::user()->id;
    $mails=DB::table('mails')->join('users','mails.publisher_id','=','users.id')->where(['publisher_id'=>$id])->paginate(10);
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.mailbox.sentmail',['profile'=>$profile,
    'title'=>$title,'mails'=>$mails,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function inbox(){
    $title='Inbox';
    $id =Auth::user()->id;
    $email = Auth::user()->email;
    $mails=DB::table('mails')->join('users','mails.publisher_id','=','users.id')->where(['to'=>$email])->orderBy('mails.mail_id','desc')->paginate(10);
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.mailbox.inbox',['profile'=>$profile,
    'title'=>$title,'mails'=>$mails,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function draft(){
    $title='Draft';
    $id =Auth::user()->id;
    $mails=DB::table('mails')->join('users','mails.publisher_id','=','users.id')->where(['publisher_id'=>$id])->paginate(10);
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.mailbox.draft',['profile'=>$profile,
    'title'=>$title,'mails'=>$mails,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function trash(){
    $title='Trash';
    $id =Auth::user()->id;
    $mails=DB::table('mails')->join('users','mails.publisher_id','=','users.id')->where(['publisher_id'=>$id])->paginate(10);
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();

    return view('admin.pages.mailbox.trash',['profile'=>$profile,
    'title'=>$title,'mails'=>$mails,'messagecount'=>$messagecount,'message'=>$message,'notification'=>$notification]);
  }

  public function sendmail(Request $request){
    $this->validate($request, [
      'to'=>['required'],
      'subject'=>['required','max:100'],
      'body'=>['required'],
     ]);

     $id =Auth::user()->id;

     $mails = new mails();
     $mails->publisher_id = $id;
     $mails->to = $request->input('to');
     $mails->subject = $request->input('subject');
     $mails->body = $request->input('body');
     if(Input::hasFile('attachment')){
         $file=Input::file('attachment');
         $file->move(public_path().'/uploads/Mail/',
         $file->getClientOriginalName());
         $url=URL::to("/").'/uploads/Mail/'.$file->getClientOriginalName();
         $mails->attachment = $url;
     }
     $mails->ststus = 'send';
     $mails->save();
     return redirect('sentbox')->with('status', 'Email Send Sucessfully');
  }

  public function adddraft(Request $request){
    $this->validate($request, [
      'to'=>['required'],
      'subject'=>['required'],
      'body'=>['required'],
     ]);

     $id =Auth::user()->id;

     $mails = new mails();
     $mails->publisher_id = $id;
     $mails->to = $request->input('to');
     $mails->subject = $request->input('subject');
     $mails->body = $request->input('body');
     if(Input::hasFile('attachment')){
         $file=Input::file('attachment');
         $file->move(public_path().'/uploads/Mail/',
         $file->getClientOriginalName());
         $url=URL::to("/").'/uploads/Mail/'.$file->getClientOriginalName();
         $mails->attachment = $url;
     }
     $mails->ststus = 'draft';
     $mails->save();
     return redirect('draft')->with('status', 'Email Added To Draft');
  }

  public function readmail($postid){
    $title='Read Mail';
    $id =Auth::user()->id;
    $mails=DB::table('mails')->join('users','mails.publisher_id','=','users.id')->where(['mails.mail_id'=>$postid])->first();
    $profile = DB::table('users')->where(['id'=>$id])->first();

    $messagecount=DB::table('messages')->where('read_or_not','0')->get();
    $message=DB::table('messages')->where('read_or_not','0')->get();

    $notification=DB::table('notifications')->where('read_or_not','0')->orderby('id','desc')->get();
    return view('admin.pages.mailbox.readmail',['profile'=>$profile,
    'title'=>$title,'mails'=>$mails,'messagecount'=>$messagecount,
    'message'=>$message,'notification'=>$notification]);
  }


}
