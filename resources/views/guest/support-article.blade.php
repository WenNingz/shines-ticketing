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
    <div class="ui padded grid">
        <div class="row"></div>
        <div class="ui text justified container">
            <div class="ui breadcrumb">
                <a href="/support" class="section">Support</a>
                <i class="right angle icon divider"></i>
                <a href="/support-search" class="section">Ticket Purchase</a>
                <i class="right angle icon divider"></i>
                <div class="active section">T-Shirt</div>
            </div>
            <div class="ui huge header">I’ve bought a ticket for my friend, but my name is on it. What do we do?</div>
            <div>
                <p>In most cases this is not a problem, only in circumstances where the event organiser has specified
                    that the name on the ticket should match the ticket holder will this be relevant. Be sure to consult
                    the event page to see if the organiser has made any specifications regarding names on tickets, and
                    whether or not IDs will be required on the door - you should contact the event organiser directly if
                    you are in any doubt at all.
                    If it is indeed the case that your friend's name needs to appear on the ticket, then click here to
                    transfer the ticket to your friend.</p>
                <p>Have more questions? <a href="/new-request">Submit a request</a></p>
            </div>
        </div>
        <div class="row"></div>
        <div class="row"></div>
    </div>
@endsection
@section('footer')
    @include('guest.footer')
@endsection