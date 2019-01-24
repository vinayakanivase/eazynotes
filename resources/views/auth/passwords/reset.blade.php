@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col-md-8 d-none d-md-block">
				<img src="{{ asset('img/auth/2.jpg') }}" class="img-fluid" alt="image">
			</div>
			
			<div class="col-md-4 p-5">
				<h2 class="heading mb-5">Reset password</h2>

				<form method="POST" action="{{ route('password.request') }}">
					@csrf

					<input type="hidden" name="token" value="{{ $token }}">

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
						<label for="password-confirm">Confirm password</label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-block btn-dark">Reset my password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
