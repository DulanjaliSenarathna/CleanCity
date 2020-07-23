<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blocked</title>
      <link rel="icon" type="image/png" href="icon/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link rel="stylesheet" href="Admin/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <style media="screen">
      h1
      {
        font-family: 'Poiret One', cursive;
        text-align: center;
      }
      .jumbotron {
        position: absolute;
        top: 40%;
        left:50%;
        transform: translate(-50%,-50%);
        background-color: #fff;
        color: red;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
        <h1>Your Account Is Temporary Blocked. Please Contact Admin</h1>


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


        <form role="form" action="{{action('BlockedController@request')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input id="email" type="text" class="form-control" name="email" placeholder="Email">
        <br>
        <div class="form-group">
          <textarea name="message" placeholder="Request Message" class="form-control" rows="5" id="comment"></textarea>
        </div>




        <div class="pull-right">
          <a href="logout" class="btn btn-default">&nbsp&nbsp&nbsp&nbsp Log Out &nbsp&nbsp&nbsp&nbsp</a>
          <button type="submit" class="btn btn-default">&nbsp&nbsp&nbsp&nbsp Send Message &nbsp&nbsp&nbsp&nbsp</button>
        </div>
        </form>

      </div>



    </div>
  </body>
</html>
