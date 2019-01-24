@extends('layouts.app-alternate')

@section('title', 'Users')

@section('content')
	<div class="container my-4 py-4">
    <div class="row my-4 align-items-center">
      <h2>Demo users</h2>
      <a href="{{ route('home') }}" class="btn btn-link ml-auto" role="button">
        Go back to home
      </a>
    </div>

    <div class="row">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
          </tr>
        </thead>
        <tbody>
          @if ($users)
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>secret</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
