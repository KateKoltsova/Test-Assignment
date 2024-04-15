@extends('welcome')

@section('head')
    Positions
@endsection

@section('content')
    <ol class="list-group list-group-numbered">
        @foreach($positions as $position)
            <li class="list-group-item">{{ $position['position'] }}</li>
        @endforeach
    </ol>
@endsection
