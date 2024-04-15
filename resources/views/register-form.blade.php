@extends('welcome')

@section('head')
    <h2>Register Form</h2>
@endsection

@section('content')
    @if($errors->get('token'))
        @foreach($errors->get('token') as $error)
            <p id="passwordHelpBlock" style="color: red">
                {{$error}}
            </p>
        @endforeach
        <a class="btn btn-primary" href="{{ route('getToken') }}">Regenerate token</a>
    @else
        <form class="form d-grid gap-2 col-12 mx-auto justify-content-center" action="{{ route('register') }}"
              method="post"
              enctype="multipart/form-data" novalidate>
            @csrf

            <div class="">
                <label for="token" class="form-label">Token</label>
                <input type="text" name="token" readonly class="form-control" id="token" value="{{$token}}">
            </div>

            <div class="">
                <label for="position_id" class="form-label"> Position </label>
                <select class="form-control
                @if($errors->get('position_id'))
                    is-invalid
                @elseif( old('position_id'))
                    is-valid
                @endif
            " name="position_id" id="position_id">
                    @foreach($positions as $position)
                        <option value="{{$position['id']}}"
                                @if(old('position_id') == $position['id']) selected @endif>{{$position['position']}}</option>
                    @endforeach
                </select>
                @foreach($errors->get('position_id') as $error)
                    <div id="passwordHelpBlock" class="form-text" style="color: red">
                        {{$error}}
                    </div>
                @endforeach
            </div>

            <div class="">
                <label for="name" class="form-label"> Name </label>
                <input class="form-control
                @if($errors->get('name'))
                    is-invalid
                @elseif( old('name'))
                    is-valid
                @endif
            " type="text" name="name" id="name"
                       placeholder="Name"
                       value="{{ old('name') }}">
                @foreach($errors->get('name') as $error)
                    <div id="passwordHelpBlock" class="form-text" style="color: red">
                        {{$error}}
                    </div>
                @endforeach
            </div>

            <div class="">
                <label for="email" class="form-label"> Email </label>
                <input class="form-control
                @if($errors->get('email'))
                    is-invalid
                @elseif( old('email'))
                    is-valid
                @endif
            " type="email" name="email"
                       id="email" placeholder="Email"
                       value="{{ old('email') }}">
                @foreach($errors->get('email') as $error)
                    <div id="passwordHelpBlock" class="form-text" style="color: red">
                        {{$error}}
                    </div>
                @endforeach
            </div>

            <div class="">
                <label for="phone" class="form-label"> Phone </label>
                <input class="form-control
                @if($errors->get('phone'))
                    is-invalid
                @elseif( old('phone'))
                    is-valid
                @endif
            " type="tel" name="phone" id="phone"
                       placeholder="Phone"
                       value="{{ old('phone') ?? '+380' }}">
                @foreach($errors->get('phone') as $error)
                    <div id="passwordHelpBlock" class="form-text" style="color: red">
                        {{$error}}
                    </div>
                @endforeach
            </div>

            <div class="">
                <label for="photo" class="form-label"> Photo </label>
                <input class="form-control
                @if($errors->get('photo'))
                    is-invalid
                @elseif( old('photo'))
                    is-valid
                @endif
            " type="file" name="photo" id="photo"
                       placeholder="Photo">
                @foreach($errors->get('photo') as $error)
                    <div id="passwordHelpBlock" class="form-text" style="color: red">
                        {{$error}}
                    </div>
                @endforeach
            </div>

            <button class="btn btn-outline-success" type="submit">Submit</button>
        </form>
    @endif
@endsection
