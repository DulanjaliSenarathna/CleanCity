@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Added Drop Locations
        <small>All Location That You added</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Drop Locations</li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Added Locations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>

        </div>
        <div class="box-body" style="height: 100%;">

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
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Added Time</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              @foreach($locations as $row)
              <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->address}}</td>
                <td>{{$row->city}}</td>
                <td>{{$row->lat}}</td>
                <td>{{$row->lng}}</td>
                <td>{{ date('d-M-Y | H:i:s', strtotime($row->created_at)) }}</td>
                <td><a href="deletelocation/{{$row->id}}" class="btn btn-danger">Delete</a></td>


                <td></td>
              </tr>
              @endforeach


              <tbody>

            </table>


          </div>



        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            {!! $locations->links(); !!}
          </ul>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    @endsection
