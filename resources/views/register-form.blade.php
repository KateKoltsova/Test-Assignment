@extends('welcome')

@section('head')
    <h2>Register Form</h2>
@endsection

@section('content')
    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="token" value="{{$token}}">

        <label for="position_id"> Position </label>
        <select name="position_id" id="position_id">
            @foreach($positions as $position)
                <option value="{{$position['id']}}"
                        @if(old('position_id') == $position['id']) selected @endif>{{$position['position']}}</option>
            @endforeach
        </select>
        @if(isset($errors))
            @foreach($errors->get('position_id') as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        <br>

        <label for="name"> Name </label>
        <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
        @if(isset($errors))
            @foreach($errors->get('name') as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        <br>

        <label for="email"> Email </label>
        <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        @if(isset($errors))
            @foreach($errors->get('email') as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        <br>

        <label for="phone"> Phone </label>
        <input type="tel" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') ?? '+380' }}">
        @if(isset($errors))
            @foreach($errors->get('phone') as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        <br>

        <label for="photo"> Photo </label>
        <input type="file" name="photo" id="photo" placeholder="Photo">
        @if(isset($errors))
            @foreach($errors->get('photo') as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        <br>
        <br>

        <input type="submit" value="Register">
    </form>
@endsection
