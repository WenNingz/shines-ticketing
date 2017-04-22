@extends('master')

@section('title', 'Support')

@section('navbar')
    @if(auth()->check())
        @if(auth()->user()->hasRole('super-admin'))
            @include('super-admin.common.navbar')
        @elseif(auth()->user()->hasRole('admin'))
            @include('admin.common.navbar')
        @elseif(auth()->user()->hasRole('attendee'))
            @include('attendee.common.navbar')
        @endif
    @else
        @include('guest.navbar')
    @endif
@endsection

@section('content')
    <div class="ui basic segment">
        <div class="ui relaxed center aligned grid">
            <div class="light-gray row">
                @include('layout.success')
            </div>
            <div class="light-gray row">
                <div class="sixteen wide mobile sixteen wide tablet four wide computer four wide large screen column"></div>
                <div class="sixteen wide mobile sixteen wide tablet eight wide computer eight wide large screen column">
                    <form method="GET" action="/support" class="ui form">
                        <h1>We're here to help</h1>
                        <h3>Get started below</h3>
                        <div class="field">
                            <div class="ui icon input">
                                <input type="text" name='query' placeholder="How can we help?">
                                <i class="blue search icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="sixteen wide mobile sixteen wide tablet four wide computer four wide large screen column"></div>
            </div>
            <div class="light-gray row"></div>
        </div>
    </div>
    <div class="ui justified container">
        <div class="ui centered grid">
            <div class="sixteen wide mobile sixteen wide tablet eight wide computer eight wide large screen column">
                <h2 class="ui header">## results for QUERY</h2>
                <div class="ui divider"></div>
                <div class="ui divided list">
                    <div class="item">
                        <div class="content">
                            <a class="header">What is booking protection, and why would I need it?</a>
                            <div class="description">
                                An excellent polish restaurant, quick delivery and hearty, filling meals.
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <a class="header">What is booking protection, and why would I need it?</a>
                            <div class="description">
                                An excellent polish restaurant, quick delivery and hearty, filling meals.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('guest.footer')
@endsection