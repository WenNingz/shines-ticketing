@extends('master')

@section('title', 'Login')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    @include('layout.flash')
    <div class="ui centered grid">
        <div class="thirteen wide mobile eleven wide tablet five wide computer five wide large screen column">
            <form method="POST" action="/login" class="ui form center aligned padded segment @if(sizeof($errors->all()) > 0)) error @endif">
                <h1 class="ui teal center aligned header">LOG IN</h1>
                <div class="ui clearing divider"></div>
                <p>New to here?? Click here to <a href="signup">Sign Up</a></p>

                {{ csrf_field() }}

                @include('layout.errors')

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>

                <button class="ui fluid teal basic button">Log In</button>

                <p><a href="#">Forgot Password??</a></p>
                <div class="ui horizontal divider">OR</div>
                <div class="ui fluid facebook button">
                    Log-in with &nbsp;
                    <i class="facebook icon"></i>
                </div>
                <br>
                <div class="ui fluid google plus button">
                    Log-in with &nbsp;
                    <i class="google plus icon"></i>
                </div>
            </form>
        </div>
    </div>
@endsection