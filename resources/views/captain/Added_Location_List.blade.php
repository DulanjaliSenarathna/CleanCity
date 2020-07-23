@extends('layouts.captain')

@section('content')
    <section class="content-header">
      <h1>
        SUBMITED LOCATION LIST
        <small>All Locations are Here</small>
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
              <h3 class="box-title">LOCATION LIST</h3>



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

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Added By</th>
                  <th>Title</th>
                  <th>City</th>
                  <th>Discription</th>
                  <th>Date</th>
                  <th>View</th>
                  <th>Verified Status</th>
                  <th>Level</th>
                  <th>Job Status</th>

                  <th>Delete</th>
                </tr>
              </thead>

              <tbody>
                @foreach($location as $row)
                <tr>
                  <td><div class="avatar"><img src="{{$row->image_url}}"></div></td>
                  <td>{{$row->name}}</td>
                  <td>{!! substr(strip_tags($row->title), 0, 50) !!}
                    @if (strlen(strip_tags($row->title)) > 50)
                         ...
                       @endif</td>
                  <td>{{$row->city}}</td>
                  <td>{!! substr(strip_tags($row->description), 0, 50) !!}
                    @if (strlen(strip_tags($row->description)) > 50)
                         ...
                       @endif</td>
                  <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
                  <td>
                      <a href="viewlocationcaptain/{{$row->id}}"  class="btn btn-default" ><i class="fa fa-eye"></i></a>
                  </td>
                  <td>
                    @if($row->job_status===1)

                    @if($row->verified_status===0)
                      <a  class="btn btn-danger" >Not Verified</a>
                    @elseif($row->verified_status===1)
                      <a  class="btn btn-success disabled">&nbsp &nbsp Verified &nbsp &nbsp</a>
                    @endif</td>

                    @elseif($row->job_status===0)

                    @if($row->verified_status===0)
                      <a href="Verifiedlocationcaptain/{{$row->id}}" class="btn btn-danger" >Not Verified</a>
                    @elseif($row->verified_status===1)
                      <a href="NotVerifiedlocationcaptain/{{$row->id}}" class="btn btn-success">&nbsp &nbsp Verified &nbsp &nbsp</a>
                    @endif
                    @endif


                    <td>
                      @if($row->job_status===1)
                      <div class="dropdown">
                        <button @if($row->level==='low')
                              class="btn btn-info dropdown-toggle disabled" type="button" data-toggle="dropdown">&nbsp &nbsp Low &nbsp &nbsp
                            @elseif($row->level==='medium')
                              class="btn btn-primary dropdown-toggle disabled" type="button" data-toggle="dropdown">Medium
                            @elseif($row->level==='high')
                              class="btn btn-warning dropdown-toggle disabled" type="button" data-toggle="dropdown">&nbsp &nbsp High  &nbsp
                            @endif

                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a >Low</a></li>
                            <li><a >Medium</a></li>
                            <li><a >High</a></li>
                          </ul>
                        </div>
                        @elseif($row->job_status===0)
                        <div class="dropdown">
                          <button @if($row->level==='low')
                                class="btn btn-info dropdown-toggle " type="button" data-toggle="dropdown">&nbsp &nbsp Low &nbsp &nbsp
                              @elseif($row->level==='medium')
                                class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Medium
                              @elseif($row->level==='high')
                                class="btn btn-warning dropdown-toggle " type="button" data-toggle="dropdown">&nbsp &nbsp High  &nbsp
                              @endif

                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="changeleveltolow/{{$row->id}}">Low</a></li>
                              <li><a href="changeleveltomedium/{{$row->id}}">Medium</a></li>
                              <li><a href="changeleveltohigh/{{$row->id}}">High</a></li>
                            </ul>
                          </div>
                        @endif
                    </td>


                      <td>
                        @if($row->job_status===0)
                          <a  class="btn btn-warning" >NOT COMPLETED</a>
                        @elseif($row->job_status===1)
                          <a  class="btn btn-success">&nbsp &nbsp COMPLETED &nbsp &nbsp &nbsp</a>
                        @endif</td>



                        <td>
                          @if($row->job_status===0)
                            <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
                          @elseif($row->job_status===1)
                            <a class="btn btn-danger disabled" ><i class="fa fa-trash" ></i></a>
                          @endif</td>

                        </td>



                </tr>


                <div class="modal modal-danger fade" id="modal-danger">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Location</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are You Sure the Delete This Location?&hellip;</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                        <a href="deletelocationcaptain/{{$row->id}}" type="button" class="btn btn-outline">Yes I want Delete</a>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>


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
