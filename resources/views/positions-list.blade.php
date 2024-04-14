@extends('welcome')

@section('head')
    Positions
@endsection

@section('content')
    <ul>
        @foreach($positions as $position)
            <li>{{ $position['position'] }}</li>
        @endforeach
    </ul>
@endsection
