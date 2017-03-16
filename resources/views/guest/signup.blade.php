@extends('master')

@section('title', 'Sign Up')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    <div class="ui centered grid">
        <div class="thirteen wide mobile eleven wide tablet five wide computer five wide large screen column">
            <form action="dashboard" method="GET" class="ui form center aligned padded segment">
                <h1 class="ui teal center aligned header">SIGN UP</h1>
                <div class="ui clearing divider"></div>
                <p>Already have an account?? <a href="login">Log In</a></p>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>

                <button class="ui fluid teal basic button">Sign Up</button>
                <p>By signing up, you agree to our <a href="#">User Agreement and Privacy Notice</a></p>
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