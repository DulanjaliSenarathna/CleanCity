@extends('layouts.Volunteer')

@section('content')

    <section class="content-header">
      <h1>
        Edit Profile
      </h1>
      <br>
      @if (count($errors) > 0)
        <div style="padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem;
          color:#721c24;background-color:#f8d7da;border-color:#f5c6cb;">
        <strong>Whoops!</strong> There were some problems with your input.<br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('profile')}}">Profile</a></li>
        <li class="active">Edit Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Profile Details</h3>
            </div>
            <form role="form" action="{{action('ProfileController@updateProfile')}}" method="POST" enctype="multipart/form-data">
              @csrf


              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif

              <div class="box-body">

                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control"  value="{{$profile->name}}" name="name">
                </div>
                <div class="form-group">
                  <label >Email address</label>
                  <input type="email" class="form-control"  value="{{$profile->email}}" name="email" disabled>
                </div>
                <div class="form-group">
                  <label >Date of Birth</label>
                  <div class="row">
                  <div class="col-xs-2">
                    <input type="text" class="form-control" value="{{ date('d', strtotime($profile->birthday)) }}" placeholder="DD" name="date">
                  </div>
                  <div class="col-xs-2">
                    <input type="text" class="form-control" value="{{ date('m', strtotime($profile->birthday)) }}" placeholder="MM" name="month">
                  </div>
                  <div class="col-xs-3">
                    <input type="text" class="form-control" value="{{ date('Y', strtotime($profile->birthday)) }}" placeholder="YYYY" name="year">
                  </div>
                </div>
                </div>

                <div class="form-group">
                  <label>Gender</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" value="Male" checked>
                        Male
                    </label>
                  </div>

                  <div class="radio">
                    <label>
                      <input type="radio" name="gender"  value="Female">
                      Female
                    </label>
                  </div>
                  </div>

                <div class="form-group">
                  <label >City</label>
                  <select class="form-control" placeholder="Enter Your City" name="city" required>
                    @if(count($cities)>0)
                      @foreach($cities->all() as $citie)
                        <option value="{{$citie->city_id}}">{{$citie->city_name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <!-- <input type="text" class="form-control" value="{{$profile->city_name}}" name="city"> -->
                </div>

                <div class="form-group">
                  <label>Suburb</label>
                  <input type="text" class="form-control" value="{{$profile->suburb}}" name="suburb">
                </div>

                <div class="form-group">
                  <label>Job Type</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="job" value="Admin" checked>
                        {{$profile->job}}
                    </label>
                  </div>
                  </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="col-md-6">

        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Update Password</h3>
          </div>
          <form role="form" action="{{action('ProfileController@updatepassword')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (session('status2'))
              <div class="alert alert-success">
                {{ session('status2') }}
              </div>
            @endif

            <div class="box-body">
              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control"  placeholder="Password" name="password">
              </div>
              <div class="form-group">
                <label >Password Confirm</label>
                <input type="password" class="form-control"  placeholder="Password Confirm" name="password_confirmation">
              </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-danger">Update Password</button>
            </div>
          </form>
        </div>
      </div>






      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Update Profile Picture</h3>
        </div>
        <form role="form" action="{{action('ProfileController@updateProfilepicture')}}" method="POST" enctype="multipart/form-data">
          @csrf


          @if (session('status3'))
            <div class="alert alert-success">
              {{ session('status3') }}
            </div>
          @endif

          <div class="box-body">
            <img src="{{$profile->profile_pic}}" class="img-circle center"
              style="width:150px; height:150px;display: block;margin-left: auto; margin-right: auto;"alt="User Image">
              <hr>

              <div class="form-group">
                <label for="exampleInputFile">Select Image</label>
                <input type="file" id="exampleInputFile" name="profile_pic">
              </div>


          <div class="box-footer">
            <button type="submit" class="btn btn-info">Update Profile Picture</button>
          </div>
        </form>
      </div>
    </div>






      </div>

    </section>
    @endsection
