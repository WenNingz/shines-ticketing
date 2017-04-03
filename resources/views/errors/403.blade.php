@extends('master')

@section('title', 'Error 403')

@section('content')
    <div class="ui stackable grid">
        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <div class="ui center aligned  basic vertical segment">
                <div id='monserrat-300' class="ui header">Error: 403 Forbidden</div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-700-22 text light-teal">
                    4<img class="icon-size" src="{{asset('img/icon/err403.png')}}">3
                </div>
            </div>
            <div class="ui center aligned basic vertical segment">
                <div class="monserrat-300-1">Sorry, access to this resources on the server is denied.</div>
                <div class="monserrat-300-1">Either check the URL or <a href="/dashboard">go home</a>.</div>
            </div>
        </div>
    </div>
@endsection