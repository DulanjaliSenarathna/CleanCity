@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        ADD MEMBERS
        <small>Add all Types of Members</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Members And Save Database</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{action('ProfileController@addProfile')}}" method="POST" enctype="multipart/form-data">
              @csrf
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

              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif

              <div class="box-body">

                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Full Name" name="name" required>
                </div>
                <div class="form-group">
                  <label >Email address</label>
                  <input type="email" class="form-control"  placeholder="Enter email" name="email" required>
                </div>
                <div class="form-group">
                  <label >Password</label>
                  <input type="password" class="form-control"  placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                  <label >Password Confirm</label>
                  <input type="password" class="form-control"  placeholder="Password Confirm" name="password_confirmation" required>
                </div>

                <div class="form-group">
                  <label >Date of Birth</label>
                  <div class="row">
                  <div class="col-xs-2">
                    <input type="text" class="form-control" placeholder="DD" name="date" required>
                  </div>
                  <div class="col-xs-2">
                    <input type="text" class="form-control" placeholder="MM" name="month" required>
                  </div>
                  <div class="col-xs-3">
                    <input type="text" class="form-control" placeholder="YYYY" name="year" required>
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
                </div>

                <div class="form-group">
                  <label>Suburb</label>
                  <input type="text" class="form-control" placeholder="Enter Your Suburb" name="suburb" required>
                </div>

                <div class="form-group">
                  <label>Job Type</label>


                  <div class="radio">
                    <label>
                      <input type="radio" name="job"  value="Staff">
                      Staff
                    </label>
                  </div>

                  <div class="radio">
                    <label>
                      <input type="radio" name="job"  value="Captain">
                      Captain
                    </label>
                  </div>

                  <div class="radio">
                    <label>
                      <input type="radio" name="job" value="Volunteer">
                      Volunteer
                    </label>
                  </div>
                  </div>


                <div class="form-group">
                  <label for="exampleInputFile">Input Profile Picture</label>
                  <input type="file" id="profile_pic" name="profile_pic">
                  <div id="profile_pic"></div>
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Member</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="col-md-6">
        <!-- USERS LIST -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Members</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($members as $row)
              <li>
                <img src="{{$row->profile_pic}}" alt="User Image" style="border-radius: 50%;width: 80px;height: 80px;
                overflow: hidden;position: relative;display: inline-block;">
                <a class="users-list-name" href="viewprofile/{{$row->id}}">{{$row->name}}</a>
                <span class="users-list-date">{{$row->job}}</span>
              </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
              <ul class="pagination pagination-sm no-margin ">
                {!! $members->links(); !!}
              </ul>
          </div>
          <!-- /.box-footer -->
        </div>
        <!--/.box -->
      </div>

  </section>

  @endsection
