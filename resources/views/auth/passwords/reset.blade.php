<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
 <link rel="icon" type="image/png" href="../../icon/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../Auth/css/util.css">
    <link rel="stylesheet" type="text/css" href="../../Auth/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

					<span class="login100-form-title p-b-32">
						Reset Password
					</span>

					<span class="txt1 p-b-11">
						Email Address
          </span>

					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
                        <input id="email" type="email" class="input100" name="email" value="{{ $email ?? old('email') }}" required autofocus>

						<span class="focus-input100"></span>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

					</div>

					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<input  id="password" type="password" class="input100"  name="password" required >
						<span class="focus-input100"></span>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
					</div>

          <span class="txt1 p-b-11">
            Confirm Password
          </span>
          <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
            <input  id="password-confirm" type="password" class="input100"  name="password_confirmation" required >
            <span class="focus-input100"></span>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset Password
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="../../Auth/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/bootstrap/js/popper.js"></script>
	<script src="../../Auth/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/daterangepicker/moment.min.js"></script>
	<script src="../../Auth/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../../Auth/js/main.js"></script>

</body>
</html>
