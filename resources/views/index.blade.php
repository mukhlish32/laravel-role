<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon"/>

	<link rel="stylesheet" href="{{ asset('libraries/bootstrap/css/bootstrap2.min.css') }}"  type="text/css">
	<link rel="stylesheet" href="{{ asset('libraries/fontawesomeold/css/font-awesome.min.css') }}" type="text/css">
	
	<link rel="stylesheet" href="{{ asset('css/login.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/plugins.css') }}" type="text/css">

	<style>
		html { 
            /* background: url({{ asset('images/bg1.jpg') }}) no-repeat center center fixed;  */
			background: url("images/bg.jpg") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
	</style>
</head>

<body class="login pt-login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="box-login">
				<div class="logo py-z">
					<a href="{{ route("home") }}">
						<img width=auto height="70" src="{{ asset('images/logo.png') }}">
					</a>
				</div>

				<form class="form-login" action="{{ route('proses-login') }}" method="post">
					@csrf
					<fieldset>
						<legend style="font-weight: bold;">
							LOGIN
						</legend>
						<p>
							Silahkan masukkan username dan password untuk login<br />
							@if ($alert = Session::get('msgbox'))
								{{-- <div class="alert alert-warning"> --}}
								<div class="alert {{ ($typebox = Session::get('typebox')) ? $typebox : '' }}">
									{{ $alert }}
								</div>
							@endif
						</p>
						{{-- <div class="form-group">
							<span class="input-icon">
								<input type="text" name="email" placeholder="Email"  value="{{ old('email') }}"
								class="form-control @error('email') is-invalid @enderror">
								<i class="fa fa-user"></i> 
								@error('email')
									<div class="invalid-feedback">{{ $message }}</div>
                        		@enderror
							</span>
						</div> --}}
						
						<div class="form-group">
							<span class="input-icon">
								<input type="text" name="username" placeholder="Username"  value="{{ old('username') }}"
								class="form-control @error('username') is-invalid @enderror">
								<i class="fa fa-user"></i> 
								@error('username')
									<div class="invalid-feedback">{{ $message }}</div>
                        		@enderror
							</span>
						</div>

						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" name="password" placeholder="Password"
								class="form-control password @error('password') is-invalid @enderror">
								<i class="fa fa-lock"></i>
								@error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
							</span>
							{{-- <a href="forgot-password.php">
								Lupa Password?
							</a> --}}
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-lg-6">
									<button type="submit" class="button-3 btn-blue" name="login" style="width: 50%">LOGIN</button>
								</div>
							</div>
						</div>
					</fieldset>
					<div class="copyright">
							&copy;
							<span class="text-bold text-uppercase"> Laravel Roles</span> 
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>