@extends('welcome')

@section('head')
    <h2>Token</h2>
@endsection

@section('content')
    <p>Your token is: {{ $token }}</p>
    <a class="btn btn-outline-primary" href="{{ route('form', ['token' => $token]) }}">Register</a>
@endsection
