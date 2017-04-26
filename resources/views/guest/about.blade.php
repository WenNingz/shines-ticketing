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
    <div class="ui inverted vertical center aligned segment">
        <div class="ui text justified container">
            <h1 class="ui inverted header">
                About Us
            </h1>
            <h4>
                ShineS ServiceS, was established in August 2016, with the intention to connect proven technology to
                evolving business needs. We aim to help our customers to deploy converging technologies which meet their
                business needs and capacity. We seek leading edge technology with relevant case references, and design
                it into our customers’ capability and capacity roadmap, from which the application shall be assimilated
                into the work environment with due consideration for man-and-technology interaction
            </h4>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui justified container">
        <h3>Four Core Values:</h3>
        <div class="ui horizontal stripe segments">
            <div class="ui red segment">
                <h3 class="ui header">Stimulating</h3>
                <p>Our work is stimulating and usually fires up the excitement in the team</p>
            </div>
            <div class="ui yellow segment">
                <h3 class="ui header">Sensible</h3>
                <p>It also has to be sensible such that we do not end up with a technology looking for an
                    application</p>
            </div>
            <div class="ui blue segment">
                <h3 class="ui header">Superior</h3>
                <p>We ensure that the quality of our work is superior from all possible aspects, yet the
                    solution we offer must be practical</p>
            </div>
            <div class="ui purple segment">
                <h3 class="ui header">Supplementary</h3>
                <p>Our recommendations usually supplement our customer’s business capacity – we are mindful that
                    our add-on value shall not be overly disruptive</p>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui justified container">
        <h3>Company Profile</h3>
        <div class="ui basic segment">
            <h5 class="ui header">Company Name:</h5>
            <p>Shines Services Pte Ltd</p>
        </div>
        <div class="ui basic segment">
            <h5 class="ui header">Address:</h5>
            <p>60 Paya Lebar Road #09-38 Paya Lebar Square</p>
            <p>Singapore, 409051</p>
        </div>
        <div class="ui basic segment">
            <h5 class="ui header">Email Us:</h5>
            <p>contact@shineservices.com</p>
        </div>
    </div>
@endsection
@section('footer')
    @include('guest.footer')
@endsection