@extends('layouts.Volunteer')

@section('content')

    <section class="content-header">
      <h1>
        User Profile
      </h1>
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{$profile->profile_pic}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$profile->name}}</h3>

              <p class="text-muted text-center">{{$profile->job}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Gender</b> <a class="pull-right">{{$profile->gender}}</a>
                </li>
                <li class="list-group-item">
                  <b>City</b> <a class="pull-right">{{$profile->city_name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Suburb</b> <a class="pull-right">{{$profile->suburb}}</a>
                </li>

                <li class="list-group-item">
                  <b>Birthday</b> <a class="pull-right">{{$profile->birthday}}</a>
                </li>
              </ul>

              <a href="{{url('volunteereditprofile')}}" class="btn btn-primary btn-block"><b>Edit Profile Details</b></a>
            </div>
          </div>
        </div>

        <div class="col-md-9">

          <div class="col-md-12">
            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-bullhorn"></i>

                <h3 class="box-title">Completed Works</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">


@foreach($location as $location)
                <div class="attachment-block clearfix">
                  <img class="attachment-img" src="{{$location->image_url}}" alt="Attachment Image">

                  <div class="attachment-pushed">
                    <h4 class="attachment-heading"><a >{{$location->title}}</a></h4>

                    <div class="attachment-text">
                      {{$location->description}}
                    </div>

                    <div style="font-weight: bold;" class="attachment-text">
                      Done By : {{$location->doneby}}
                    </div>
                    <!-- /.attachment-text -->
                  </div>
                  <!-- /.attachment-pushed -->
                </div>
  @endforeach


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          </div>



          <div class="col-md-12">
            <div class=" clearfix">
              <ul class="pagination pagination-sm no-margin pull-left">
              </ul>
            </div>
          </div>



        </div>

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  @endsection
