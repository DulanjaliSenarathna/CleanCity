<?php


use App\citie;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// middleware and routs==============================================
Route::get('/checkUserType','CheckUserTypeController@checkUserType');
Route::get('/dashboard', 'AdminController@dashboard')->middleware('Admin')->name('dashboard');
Route::get('/captainPage','CaptainController@captainprofile')->middleware('Captain')->name('captainPage');
Route::get('/staffPage','StaffController@getStaffView')->middleware('Staff')->name('staffPage');
Route::get('/volunteerPage','VolunteerController@volunteerprofile')->middleware('Volunteer')->name('volunteerPage');
Route::get('/blocked','BlockedController@getblockedView')->middleware('blocked')->name('blocked');





Route::group(['middleware' => 'revalidate'], function()
{

  Route::get('/', 'BlogController@index');

  Route::get('/register', function () {
      $city=DB::table('cities')->first();
      return view('auth.register',['city'=>$city]);
  });

  Auth::routes();

  Route::get('members','MemberController@index')->middleware('Admin');

  Route::get('addmembers','MemberController@addmembers')->middleware('Admin');

  Route::get('profile','ProfileController@profile');

  Route::get('addcities','CityController@addcities')->middleware('Admin');

  Route::get('postarticle','PostController@postarticle')->middleware('Admin');

  Route::get('editprofile','ProfileController@editprofile');


  Route::get('compose','MailController@compose');
  Route::get('sentbox','MailController@sentbox');
  Route::get('inbox','MailController@inbox');
  Route::get('draft','MailController@draft');
  Route::get('trash','MailController@trash');


  Route::get('droplocation','LocationController@droplocation');
  Route::get('droplocationlist','LocationController@droplocationlist');
  Route::get('deletelocation/{id}','LocationController@deletelocation');



  Route::get('/home', 'HomeController@index')->name('home')->middleware('Admin');

  Route::get('/post', 'PostController@post')->middleware('Admin');;

  Route::get('/category', 'categoryController@category')->middleware('Admin');;

  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

  Route::get('changejobtocaptain/{id}', 'MemberController@changejobtocaptain');
  Route::get('changejobtovolunteer/{id}', 'MemberController@changejobtovolunteer');
  Route::get('changejobtostaff/{id}', 'MemberController@changejobtostaff');

  Route::get('block/{id}', 'MemberController@block');
  Route::get('unblock/{id}', 'MemberController@unblock');

  Route::get('deleteprofile/{id}', 'MemberController@deleteprofile');

  Route::get('viewprofile/{ids}', 'ProfileController@viewprofile');

  Route::get('readmail/{postid}', 'MailController@readmail');





  Route::get('messages','ContactController@messagesview')->middleware('Admin');

  Route::get('markAsUnread/{id}', 'ContactController@markAsUnread');
  Route::get('markAsRead/{id}', 'ContactController@markAsRead');

  Route::get('/save','LocationController@save');



  //admin route post
    Route::post('/addCategory', 'categoryController@addcategory')->middleware('Admin');

    Route::post('/savespot', 'AdminController@savespot');

    Route::post('/addProfile', 'ProfileController@addProfile');

    Route::post('/updateProfile', 'ProfileController@updateProfile');

    Route::post('/updatepassword', 'ProfileController@updatepassword');

    Route::post('/updateProfilepicture', 'ProfileController@updateProfilepicture');

    Route::post('/searchmember', 'MemberController@searchmember')->middleware('Admin');

    Route::post('/addPost', 'PostController@addPost')->middleware('Admin');

    Route::post('/addcity', 'CityController@addcity')->middleware('Admin');

    Route::post('/sendmail', 'MailController@sendmail')->middleware('Admin');

    Route::post('/adddraft', 'MailController@adddraft')->middleware('Admin');

    Route::post('/contactSave', 'ContactController@contactSave');

    Route::post('/request', 'BlockedController@request')->middleware('Admin');


    //staff Routes
      Route::get('staffAllSubmitedLocationList','StaffController@staffAllSubmitedLocationList');
      Route::get('markascompletejon/{id}', 'StaffController@markascompletejon');
      Route::get('markasnotcompletejon/{id}', 'StaffController@markasnotcompletejon');
      Route::get('staffditprofile','StaffController@staffditprofile');
      Route::get('staffprofile','StaffController@getStaffView');


//captain Routes
  Route::get('captainprofile','CaptainController@captainprofile');
  Route::get('captaineditprofile','CaptainController@captaineditprofile');
  Route::get('CaptainAllSubmitedLocationList','CaptainController@CaptainAllSubmitedLocationList');
  Route::get('viewlocationcaptain/{id}', 'CaptainController@viewlocationcaptain');
  Route::get('deletelocationcaptain/{id}', 'CaptainController@deletelocation');
  Route::get('deletelocationcaptainRedirectAllLocation/{id}', 'CaptainController@deletelocationcaptainRedirectAllLocation');
  Route::get('Verifiedlocationcaptain/{id}', 'CaptainController@Verifiedlocationcaptain');
  Route::get('NotVerifiedlocationcaptain/{id}', 'CaptainController@NotVerifiedlocationcaptain');
  Route::get('changeleveltolow/{id}', 'CaptainController@changeleveltolow');
  Route::get('changeleveltomedium/{id}', 'CaptainController@changeleveltomedium');
  Route::get('changeleveltohigh/{id}', 'CaptainController@changeleveltohigh');
  Route::get('pendingtoapprove','CaptainController@pendingtoapprove');


  //Volunteer Routes
  Route::get('Submit_Location','VolunteerController@Submit')->middleware('Volunteer');
  Route::get('SubmitedLocationList','VolunteerController@SubmitedLocationList')->middleware('Volunteer');
  Route::get('AllSubmitedLocationList','VolunteerController@AllSubmitedLocationList')->middleware('Volunteer');
  Route::post('/saveLocation', 'VolunteerController@saveLocation')->middleware('Volunteer');
  Route::get('deletelocation/{id}', 'VolunteerController@deletelocation')->middleware('Volunteer');
  Route::get('viewlocation/{id}', 'VolunteerController@viewlocation')->middleware('Volunteer');
  Route::post('/updateLocation', 'VolunteerController@updateLocation')->middleware('Volunteer');
  Route::get('volunteerprofile','VolunteerController@volunteerprofile')->middleware('Volunteer');
  Route::get('volunteereditprofile','VolunteerController@volunteereditprofile')->middleware('Volunteer');
  Route::get('CompletedLocationList','VolunteerController@CompletedLocationList')->middleware('Volunteer');




//Blog Routes
  Route::get('viewpost/{ids}', 'BlogController@viewpost');
  Route::get('deletepost/{ids}', 'BlogController@deletepost');
  Route::get('contact','ContactController@contactView');
  Route::get('spots','BlogController@spots');
  Route::post('/Newsletter', 'BlogController@Newsletter');

  Route::post('/contactSave', 'ContactController@contactSave');


});
