@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<app-main :user="{{	user()	}}"></app-main>
@endsection
