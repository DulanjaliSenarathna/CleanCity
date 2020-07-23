<!DOCTYPE html>
<html lang="en">
<head>
	<title>CMCSCS | User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="icon/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Auth/css/util.css">
    <link rel="stylesheet" type="text/css" href="Auth/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
                    @csrf


                    @if (session('response'))
                <div class="alert alert-success">{{session('response')}}</div>
            @endif

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

						<!-- @if (count($errors) > 0)
												<span class="invalid-feedback" role="alert">
														<strong>{{ $errors->first('email') }}</strong>
												</span>
						@endif -->

					<span class="login100-form-title p-b-32">
						Account Login
					</span>

					<span class="txt1 p-b-11">
						Username
          </span>

					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                        <input class="input100" type="email" name="email" required>

						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" required >
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full">
						<div class="contact100-form-checkbox">
                            <a href="{{url('/register')}}" class="txt3" >
                                Register As Volunteer
							</a>
						</div>

						<div>
							<a href="{{ route('password.request') }}" class="txt3">
								Forgot Password?
							</a>
						</div>
					</div>




					<div class="flex-sb-m w-full p-b-28">
						<div class="m-l-20">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

							<label class="txt3" for="remember">
								Remember Me
							</label>
						</div>


					</div>



					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="Auth/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Auth/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Auth/bootstrap/js/popper.js"></script>
	<script src="Auth/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Auth/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Auth/daterangepicker/moment.min.js"></script>
	<script src="Auth/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Auth/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Auth/js/main.js"></script>

</body>
</html>
