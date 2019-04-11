
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daily Rashan - Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
               
				<form class="login100-form validate-form" method="post" action="{{ url('check_user') }}">
					@csrf
                    
					<span class="login100-form-title p-b-43">
							<img src="ss.png" alt="" style="height:115px;">
							@if(session()->has('message'))
							<hr>
						<h5>Username / Password <b>Invalid.</b> </h5>	
						<hr>
						@endif
					
					</span>

					<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" autocomplete="off">
						<span class="label-input100">Username</span>
					</div>


					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" autocomplete="off">
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>

					<div class="text-center w-full p-t-23 ">
						<a href="#" class="txt1 active">
							<b>Forgot password?</b> 
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js" type="ffc5af5973e6d7051aa01c09-text/javascript"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="ffc5af5973e6d7051aa01c09-text/javascript"></script> --}}
	{{-- <script type="ffc5af5973e6d7051aa01c09-text/javascript">
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script> --}}
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="ffc5af5973e6d7051aa01c09-|49" defer=""></script></body>
</html>
