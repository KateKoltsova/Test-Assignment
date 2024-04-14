@extends('welcome')

@section('head')
    Users
@endsection

@section('content')
    <p>Page {{$users['page']}}</p>
    <p>Per page {{$users['count']}}</p>
    <p>Total pages {{$users['total_pages']}}</p>
    <p>Total users {{$users['total_users']}}</p>

    <form action="{{ route('users.list') }}" method="get">
        <label for="count">Users per page</label>
        <select name="count" id="count">
            @for($i = 5; $i <= 100; $i*=2)
                <option value="{{$i}}" @if($users['count'] == $i) selected @endif>{{$i}}</option>
            @endfor
        </select>
        <button type="submit">Submit</button>
    </form>

@endsection

@section('tbody')
    @foreach($users['users'] as $user)
        <tr>
            <td><img src="{{ $user['photo'] }}" alt="User Photo"></td>
            <td>{{ $user['position'] }}</td>
            <td>{{ $user['name'] }} </td>
            <td>{{ $user['email'] }} </td>
            <td>{{ $user['phone'] }} </td>
            <td>{{ Carbon\Carbon::createFromTimestamp($user['registration_timestamp'])->toDateTimeString() }} </td>
            <td>
                <button><a href="{{ route('users.view', ['id' => $user['id']]) }}">View</a></button>
            </td>
        </tr>
    @endforeach
@endsection

@section('nav-buttons')
    <button>
        <a href="{{ route('users.list', ['page' => $users['page'], 'count' => $users['count'], 'show_more' => $users['count']]) }}">Show
            more</a></button>

    @if ($users['links']['prev_url'])
        @php
            $parsed_url = parse_url($users['links']['prev_url']);
            parse_str($parsed_url['query'], $query_params);
            $page = $query_params['page'];
            $count = $query_params['count'];
        @endphp
        <button><a href="{{ route('users.list', ['page' =>$page, 'count' => $count]) }}">Previous page</a></button>
    @endif

    @for($i = 1; $i <= $users['total_pages']; $i++)
        <button><a href="{{ route('users.list', ['page' => $i, 'count' => $users['count']]) }}">{{$i}}</a></button>
    @endfor

    @if($users['links']['next_url'])
        @php
            $parsed_url = parse_url($users['links']['next_url']);
            parse_str($parsed_url['query'], $query_params);
            $page = $query_params['page'];
            $count = $query_params['count'];
        @endphp
        <button><a href="{{ route('users.list', ['page' =>$page, 'count' => $count]) }}">Next page</a></button>
    @endif
@endsection
