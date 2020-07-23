@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Member Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('members')}}"> Members</a></li>
        <li class="active">Member Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile ">
              <img class="profile-user-img img-responsive img-circle " src="{{$user->profile_pic}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->job}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Gender</b> <a class="pull-right">{{$user->gender}}</a>
                </li>
                <li class="list-group-item">
                  <b>City</b> <a class="pull-right">{{$user->city_name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Suburb</b> <a class="pull-right">{{$user->suburb}}</a>
                </li>
                <li class="list-group-item">
                  <b>Birthday</b> <a class="pull-right">{{$user->birthday}}</a>
                </li>
              </ul>

              <a href="" class="btn btn-success btn-block"><b>Send Email</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  @endsection
