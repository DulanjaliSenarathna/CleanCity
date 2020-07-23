<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign Up Form</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="icon" type="image/png" href="icon/favicon.ico"/>

    <link rel='stylesheet' href='Admin/bower_components/font-awesome/css/font-awesome.min.css'>

    <link rel="stylesheet" href="Auth/css/style.css">
    <link rel="stylesheet" type="text/css" href="Auth/css/util.css">

</head>

<body>


<div class="container">
  <form method="POST" action="{{ route('register') }}">
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
    <div class="row">
      <h4>Account</h4>
      <div class="input-group input-group-icon">
        <input class="input100" type="text" name="name" placeholder="Full Name" required/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input class="input100" type="email" name="email" placeholder="Email Adress" required/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input class="input100" type="password" name="password"  placeholder="Password" required/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input class="input100" type="password" id="password_confirmation" name="password_confirmation" placeholder="Re Enter Password" required/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input class="input100" type="text" name="date" placeholder="DD" required/>
          </div>
          <div class="col-third">
            <input class="input100" type="text" name="month" placeholder="MM" required/>
          </div>
          <div class="col-third">
            <input class="input100" type="text" name="year" placeholder="Year" required/>
          </div>
        </div>
      </div>
      <div class="col-half ">
        <h4>Gender</h4>
        <div class="input-group input100">
          <input type="radio" name="gender" value="Male" id="gender-male"/>
          <label for="gender-male">Male</label>
          <input type="radio" name="gender" value="Female" id="gender-female"/>
          <label for="gender-female">Female</label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-half">
        <h4>City</h4>
        <div class="input-group">
        <select class="input100" placeholder="Enter Your City" name="city" required>
          @if(count($cities)>0)
            @foreach($cities->all() as $citie)
              <option value="{{$citie->city_id}}">{{$citie->city_name}}</option>
            @endforeach
          @endif
        </select>
        </div>
        <!-- <div class="input-group">
          <input class="input100" name="city" type="text" placeholder="Your City" required/>
        </div> -->
      </div>
      <div class="col-half">
        <h4>Suburb</h4>
        <div class="input-group">
          <input class="input100" name="suburb" type="text" placeholder="Your Suburb" required/>
        </div>
      </div>
    </div>


    <div class="flex-sb-m w-full p-b-20">
        <div class="contact100-form-checkbox">
            {{--  <a href="{{url('/signup')}}" class="txt3" >
                Register As Volunteer
            </a>  --}}
        </div>

        <div>
            <a href="{{url('/login')}}" class="txt3">
                Go to Sign In Window
            </a>
        </div>
    </div>


    <div>
      <button class="login100-form-btn">
        Register
      </button>
    </div>


  </form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="js/index.js"></script>




</body>

</html>
