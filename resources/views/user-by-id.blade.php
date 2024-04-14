@extends('welcome')

@section('head')
    User {{$user['id']}}
@endsection

@section('tbody')
    <tr>
        <td><img src="{{ $user['photo'] }}" alt="User Photo"></td>
        <td>{{ $user['position'] }}</td>
        <td>{{ $user['name'] }} </td>
        <td>{{ $user['email'] }} </td>
        <td>{{ $user['phone'] }} </td>
        <td>{{ Carbon\Carbon::createFromTimestamp($user['registration_timestamp'])->toDateTimeString() }} </td>
    </tr>
@endsection

@section('nav-buttons')
    <button><a href="{{ route('users.list') }}">Users List</a></button>
@endsection
