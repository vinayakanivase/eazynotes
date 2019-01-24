@extends('layouts.app')

@section('title', 'Email')

@section('content')
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col-md-8 d-none d-md-block">
				<img src="{{ asset('img/auth/3.jpg') }}" class="img-fluid" alt="image">
			</div>
			
			<div class="col-md-4 p-5">
				<h2 class="heading mb-5">Forgot password?</h2>

				@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
				@endif
										
				<form method="POST" action="{{ route('password.email') }}">
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
						<button type="submit" class="btn btn-block btn-dark">
							Send password reset link
						</button>

						<a class="btn btn-block btn-link mt-4" href="{{ route('home') }}">
							<small>Go back to homepage</small>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
