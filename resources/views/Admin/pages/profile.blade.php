@extends('layouts.admin')

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

              <a href="{{url('editprofile')}}" class="btn btn-primary btn-block"><b>Edit Profile Details</b></a>
            </div>
          </div>
        </div>

        <div class="col-md-9">

@foreach ($post as $posts)
          <div class="col-md-6" style="flort:left;">

            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" data-toggle="dropdown" class="btn btn-box-tool dropdown"><i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu">
                    <li><a href="viewpost/{{$posts->postid}}">View</a></li>
                    <li><a href="deletepost/{{$posts->postid}}">Delete</a></li>
                  </ul>
                </div>
                <div class="user-block">
                  <img class="img-circle" src="{{$posts->profile_pic}}" alt="User Image">
                  <span class="username"><a>{{$posts->name}}</a></span>
                  <span class="description">Shared publicly : {{ date('D-M-Y', strtotime($posts->publish_date)) }}</span>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <img class="img-responsive pad" src="{{$posts->post_image}}"  style="height:300px;overflow: hidden;"alt="Photo">
                <a href="viewpost/{{$posts->postid}}"><h4>{!! substr(strip_tags($posts->post_title), 0, 40) !!}
                  @if (strlen(strip_tags($posts->post_title)) > 40)</a>
                       ...
                     @endif</h4>
                <p>{!! substr(strip_tags($posts->post_body), 0, 180) !!}
                  @if (strlen(strip_tags($posts->post_body)) > 180)
                       ... <a href="viewpost/{{$posts->postid}}" class="btn btn-info btn-sm">Read More</a>
                     @endif  </p>
                <!-- <p>{!! $posts->post_body !!}</p> -->
                <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                <span class="pull-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
              <div class="box-footer">
                <form action="#" method="post">
                  <img class="img-responsive img-circle img-sm" src="{{$posts->profile_pic}}" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                  </div>
                </form>

              </div>
              <!-- /.box-footer -->
            </div>

          </div>
          @endforeach



          <div class="col-md-12">
            <div class=" clearfix">
              <ul class="pagination pagination-sm no-margin pull-left">
                {!! $post->links(); !!}
              </ul>
            </div>
          </div>



        </div>

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  @endsection
