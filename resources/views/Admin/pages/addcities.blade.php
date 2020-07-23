@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Add Cities
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Cities</li>
      </ol>
    </section >

    <section class="content">



      <div class="row">
        <div class="col-xs-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Add Cities For the Registration</h3>
            </div>

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
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="{{action('CityController@addcity')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" name="city">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat" name="button">ADD</button>
                  </span>

                </div>

              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>





        <div class="col-xs-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Number Of Cities : {{$citycount}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>City</th>
                </tr>
                </thead>
                @foreach($citys as $city)
                <tbody>
                <tr>
                  <td>{{$city->city_id}}</td>
                  <td>{{$city->city_name}}</td>
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              {!! $citys->links(); !!}
              </ul>
            </div>
          </div>
        </div>













        </div>

    </section>
  @endsection
