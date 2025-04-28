<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="{{ asset('assetLogin/images/icons/logo.png')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/animate/animate.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/select2/select2.min.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/css/main.css')}}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf 
					
					<div class="wrap-pic-logo"> 
                        <img src="{{ asset('assetLogin/images/icons/logo.png')}}" class="logo" alt="LOGO"> 
                    </div>
                    
                    <span class="login100-form-title p-b-26">
						Sistem Absensi
					</span>

					<div class="wrap-input100 validate-input" data-validate="Masukkan Email">
						<input class="input100" type="email" name="email" value="{{ old('email') }}">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					@error('email')
						<div class="text-danger text-center">{{ $message }}</div>
					@enderror

					<div class="wrap-input100 validate-input" data-validate="Masukkan Password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					@error('password')
						<div class="text-danger text-center">{{ $message }}</div>
					@enderror

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					@if(session('error'))
						<div class="text-danger text-center mt-2">{{ session('error') }}</div>
					@endif
				</form>
			</div>
		</div>
	</div>
	
	<script src="{{ asset('assetLogin/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/animsition/js/animsition.min.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/select2/select2.min.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{ asset('assetLogin/vendor/countdowntime/countdowntime.js')}}"></script>
	<script src="{{ asset('assetLogin/js/main.js')}}"></script>

</body>
</html>
