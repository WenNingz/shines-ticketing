@extends('master')

@section('title', 'Error 500')

@section('content')
    <div class="ui stackable grid">
        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <div class="ui center aligned  basic vertical segment">
                <div id='monserrat-300' class="ui header">Error: 500 Unexpected Error</div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-700-16 text light-teal">
                    5<img class="icon-size" src="{{asset('img/icon/err500.png')}}">0
                </div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-300-1">An error occured and your request couldn't be completed.</div>
                <div class="monserrat-300-1">Either check the URL or <a href="/dashboard">go home</a>.</div>
            </div>
        </div>
    </div>
@endsection