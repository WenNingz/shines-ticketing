@extends('master')

@section('title', 'Error 404')

@section('content')
    <div class="ui stackable grid">
        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <div class="ui center aligned  basic vertical segment">
                <div id='monserrat-300' class="ui header">Error: 404 Page Not Found</div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-700-22 text light-teal">
                    4<img class="icon-size" src="{{asset('img/icon/err404.png')}}">4
                </div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-300-1">Sorry, the page you're looking for cannot be accessed.</div>
                <div class="monserrat-300-1">Either check the URL or <a href="/dashboard">go home</a>.</div>
            </div>
        </div>
    </div>
@endsection