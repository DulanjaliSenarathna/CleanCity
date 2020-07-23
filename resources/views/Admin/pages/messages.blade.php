@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        MESSAGE LIST
        <small>All Messages are Here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Messages</li>
      </ol>
    </section>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
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



    <!-- Main content -->
    <section class="content">

      @foreach($messagesview as $msg)
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div @if(($msg->read_or_not)===0) class="box box-danger" @else class="box box-success" @endif>
            <div class="box-header">
              <h3 class="box-title">{{$msg->subject}}</h3> <br>
              <div class="box-tools pull-right">
                @if(($msg->read_or_not)===0)
                <a href="markAsRead/{{$msg->id}}" class="btn btn-danger">
                  <span class="glyphicon glyphicon-check"></span> Mark As Read
                </a>
                @else
                <a href="markAsUnread/{{$msg->id}}" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span> Mark As UnRead
                </a>
                @endif
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="col-md-12">
                <div class="col-md-4">
                  <span class="description"><i class="fa fa-user-o"></i>&nbsp : <b>{{$msg->name}}</b> </span>
                </div>
                <div class="col-md-4">
                  <span class="description"><i class="fa fa-envelope-o"></i>&nbsp : {{$msg->email}}</span><br>
                </div>
                <div class="col-md-4">
                  <span class="description"><i class="fa fa-clock-o">
                  </i>&nbsp &nbsp {{ date('d-M-Y | h:i:s A', strtotime($msg->created_at)) }}</span>
                </div>
                <hr>
              </div>
              <div class="col-md-12">
                <div class="col-md-8">
                  <p>{{$msg->message}}</p>
                </div>

              </div>



            </div>
          </div>



          <!-- /.box -->
        </div>
      </div>
      @endforeach
    </section>
  @endsection
