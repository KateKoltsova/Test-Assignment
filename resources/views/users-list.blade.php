@extends('welcome')

@section('head')
    Users
@endsection

@section('content')
    <div class="mb-2">Page {{$users['page']}}</div>
    <div class="mb-2">Per page {{$users['count']}}</div>
    <div class="mb-2">Total pages {{$users['total_pages']}}</div>
    <div class="mb-2">Total users {{$users['total_users']}}</div>

    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Users per page
        </button>
        <ul class="dropdown-menu">
            @for($i = 5; $i <= 100; $i*=2)
                <li><a class="dropdown-item" href="{{ route('users.list', ['count' => $i]) }}">{{$i}}</a></li>
            @endfor
        </ul>
    </div>
@endsection

@section('tbody')
    @foreach($users['users'] as $user)
        <tr>
            <td><img src="{{ $user['photo'] }}" class="img-thumbnail rounded mx-auto d-block" alt="User Photo"></td>
            <td>{{ $user['position'] }}</td>
            <td>{{ $user['name'] }} </td>
            <td>{{ $user['email'] }} </td>
            <td>{{ $user['phone'] }} </td>
            <td>{{ Carbon\Carbon::createFromTimestamp($user['registration_timestamp'])->toDateTimeString() }} </td>
            <td>
                <a class="btn btn-outline-info" href="{{ route('users.view', ['id' => $user['id']]) }}">View</a>
            </td>
        </tr>
    @endforeach
@endsection

@section('nav-buttons')
    <div class="d-grid col-8 mx-auto justify-content-center">
        <a class="btn btn-success"
           href="{{ route('users.list', ['page' => $users['page'], 'count' => $users['count'], 'show_more' => $users['count']]) }}">
            Show more</a>
    </div>
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            @if ($users['links']['prev_url'])
                @php
                    $parsed_url = parse_url($users['links']['prev_url']);
                    parse_str($parsed_url['query'], $query_params);
                    $page = $query_params['page'];
                    $count = $query_params['count'];
                @endphp
                <li class="page-item"><a class="page-link"
                                         href="{{ route('users.list', ['page' =>$page, 'count' => $count]) }}">Previous</a>
                </li>
            @endif

            @for($i = 1; $i <= $users['total_pages']; $i++)
                <li class="page-item @if($users['page'] == $i) active @endif"><a class="page-link"
                                                                                 href="{{ route('users.list', ['page' => $i, 'count' => $users['count']]) }}">{{$i}}</a>
                </li>
            @endfor

            @if($users['links']['next_url'])
                @php
                    $parsed_url = parse_url($users['links']['next_url']);
                    parse_str($parsed_url['query'], $query_params);
                    $page = $query_params['page'];
                    $count = $query_params['count'];
                @endphp
                <li class="page-item"><a class="page-link"
                                         href="{{ route('users.list', ['page' =>$page, 'count' => $count]) }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
@endsection
