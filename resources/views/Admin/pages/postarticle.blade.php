@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Post Article
        <small>post articles to improve public awareness</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Post Article</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
            </div>
            <div class="box-body pad form-group">



              <form role="form" action="{{action('PostController@addPost')}}" method="POST" enctype="multipart/form-data">
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



                <h5>Title</h5>
                  <input type="text" class="form-control" name="post_title"></input>
                  <div class="form-group">
                    <h5>Category</h5>
                    <select name="category" class="form-control select2" style="width: 30%;">
                      <option value="Recycling" selected="selected">Recycling</option>
                      <option value="Home Waste">Home Waste</option>
                      <option value="Industrial Waste">Industrial Waste</option>
                      <option value="Plastic Recycling">Plastic Recycling</option>
                      <option value="Recyling Technology">Recyling Technology</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                    <div class="form-group">
                      <h5>Upload Image</h5>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <span class="btn btn-default btn-file">
                            Browse… <input name="post_image" type="file" id="imgInp">
                          </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                      <img id='img-upload'/>
                    </div>
                    <h5>Body</h5>
                      <textarea id="editor1" name="post_body" rows="10" cols="80"></textarea>
                        <hr>
                        <button type="submit" class="btn btn-success btn-lg pull-right">Publish Article</button>
                  </form>






            </div>
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
  @endsection
