@extends('layouts.app')

@section('title', 'Login')

@section('content')
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col-md-8 d-none d-md-block">
				<img src="{{ asset('img/auth/1.jpg') }}" class="img-fluid" alt="image">
			</div>
			
			<div class="col-md-4 p-5">
				<h2 class="heading mb-5">Already registered?</h2>

				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="form-group">
						<label for="email">E-mail address</label>
						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
						
						@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
						
						@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="form-check-label" for="remember">Remember me</label>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-block btn-dark">Login</button>

						<a href="{{ route('register') }}" class="btn btn-block btn-outline-secondary">
							Register an account
						</a>

						<a class="btn btn-link mt-4" href="{{ route('password.request') }}">
							<small>Forgot your password?</small>
						</a>

						<a class="btn btn-link mt-4" href="{{ route('users-list') }}">
							<small>See a list of demo users</small>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
