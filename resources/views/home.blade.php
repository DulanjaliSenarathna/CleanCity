@extends('layouts.app')

<style type="text/css">
  .avatar{
    border-radius: 100%;
    max-width: 100px;
  }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('response'))
                <div class="alert alert-success">{{session('response')}}</div>
            @endif


            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                  <div class="col-md-4">
                    <img src="{{url('images\avatar.png')}}" class="avatar">
                  </div>
                  <div class="col-md-8"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
