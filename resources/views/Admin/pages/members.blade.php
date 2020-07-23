@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        MEMBERS LIST
        <small>All Members are Here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Members</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Members Details</h3>



              <div class="box-tools">

                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" id="search"  class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>

              </div>




            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Job Type</th>
                  <th>Change Job</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>Suburb</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($members as $row)
                <tr>
                  <td>{{$row->id}}</td>
                  <td><div class="avatar"><img src="{{$row->profile_pic}}"></div></td>

                  <td>
                  {{$row->name}}</td>
                  <td>@if($row->job==='Admin')
                    <span class="label label-primary">{{$row->job}}</span>
                  @elseif($row->job==='Captain')
                  <span class="label label-danger">{{$row->job}}</span>
                  @elseif($row->job==='Volunteer')
                  <span class="label label-success">{{$row->job}}</span>
                  @elseif($row->job==='Staff')
                  <span class="label label-warning">{{$row->job}}</span>
                  @else($row->job==='blocked')
                  <span class="label label-default">{{$row->job}}</span>
                  @endif</td>
                  <td>
                    @if($row->job==='Admin')
                    @else
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Change Job
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="changejobtocaptain/{{$row->id}}">Captain</a></li>
                          <li><a href="changejobtovolunteer/{{$row->id}}">Volunteer</a></li>
                          <li><a href="changejobtostaff/{{$row->id}}">Staff</a></li>
                        </ul>
                      </div>
                    @endif
                  </td>
                  <td>{{$row->email}}</td>
                  <td>{{$row->city_name}}</td>
                  <td>{{$row->suburb}}</td>


                  <td>
                    @if($row->job==='Admin')
                    @else
                    <a href="../viewprofile/{{$row->id}}" class="btn btn-primary">View</a>
                    @if($row->job==='unblocked'||$row->job==='Staff'||$row->job==='Volunteer'||$row->job==='Captain')
                    <a href="block/{{$row->id}}" type="button" class="btn btn-warning">&nbsp&nbspBlock&nbsp&nbsp</a>
                    @elseif($row->job==='blocked')
                    <a href="unblock/{{$row->id}}" type="button" title="If You Want Unblock,Please Add Job Type" class="btn btn-default" disabled>BLOCKED</a>
                    @endif
                    <span><a  type="button" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger remove">Delete</a>

                      <div class="modal modal-danger fade" id="modal-danger">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Delete Member</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are You Sure the Delete This Member?&hellip;</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                              <a href="deleteprofile/{{$row->id}}" type="button" class="btn btn-outline">Yes I want Delete</a>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    </span>
                    @endif
                  </td>
                </tr>



                @endforeach
                <tbody>

              </table>


            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {!! $members->links(); !!}
              </ul>
            </div>
          </div>



          <!-- /.box -->
        </div>
      </div>
    </section>
  @endsection
