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
                    <form method="GET" action="/support-search" class="ui form">
                        <h1>We're here to help</h1>
                        <h3>Get started below</h3>
                        <div class="field">
                            <div class="ui icon input">
                                <input type="text" name='query' placeholder="How can we help?">
                                <i class="blue search icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui labels">
                                <a class="ui blue basic circular prompt label">Events</a>
                                <a class="ui blue basic circular prompt label">Tickets Purchase</a>
                                <a class="ui blue basic circular prompt label">Payments</a>
                                <a class="ui blue basic circular prompt label">Account</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="sixteen wide mobile sixteen wide tablet four wide computer four wide large screen column"></div>
            </div>
            <div class="light-gray row"></div>
        </div>
    </div>
    <h2 class="ui center aligned header">Most Asked</h2>
    <div class="ui justified container">
        <div class="ui centered grid">
            <div class="sixteen wide mobile sixteen wide tablet eight wide computer eight wide large screen column">

                <div class="ui list">
                    <a href="/support-article" class="item">What is a FAQ?</a>
                    <a href="/support-article" class="item">Who is our user?</a>
                    <a href="/support-article" class="item">I’ve bought a ticket for my friend, but my name is on it.
                        What do we do?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('guest.footer')
@endsection