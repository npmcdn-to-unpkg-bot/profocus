@extends('layouts.app')


@section('content')

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">PF</h1>

            </div>
            <h3>Добро пожаловать</h3>
            <p></p>
            <form class="m-t" role="form" method="POST"  action="{{ url('/login') }}">
                {!! csrf_field() !!}


                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" placeholder="Пароль"  class="form-control" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                </div>


                <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>

                <a href="#"><small>Забыл(а) пароль?</small></a>
            </form>
        </div>
    </div>



@endsection
