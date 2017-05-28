@extends('master')

@section('title', 'Dashboard')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Dashboard
            </h3>

            <h4 class="ui centered dividing header">
                Weekly Records
            </h4>
            <div class="ui four column center aligned doubling stackable grid">
                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="orange column">
                            <div><i class="big calendar outline icon"></i></div>
                            <div class="ui horizontal divider"></div>
                            <div><b>TOTAL EVENTS</b></div>
                        </div>
                        <h4 class="box column">{{ $total_events }}</h4>
                    </div>
                </div>
                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="purple column">
                            <div><i class="big ticket icon"></i></div>
                            <div><b>TICKETS SOLD</b></div>
                        </div>
                        <h4 class="box column">{{ $ticket_sold }}</h4>
                    </div>
                </div>
                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="green column">
                            <div><i class="big dollar icon"></i></div>
                            <div><b>TOTAL SALES</b></div>
                        </div>
                        <h4 class="box column">${{ number_format($sales, 2, '.', ',') }}</h4>
                    </div>
                </div>
            </div>

            <h4 class="ui centered dividing header">
                Quick Menu
            </h4>
            <div class="ui seven column center aligned doubling stackable grid">
                <a href="/sync-events" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black refresh icon"></i></div>
                        <div><h3>Sync Events</h3></div>
                    </div>
                </a>

                <a href="/manage-attendee" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black users icon"></i></div>
                        <div><h3>Manage Users</h3></div>
                    </div>
                </a>

                <a href="/ticket-list" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black help icon"></i></div>
                        <div><h3>Reply Support</h3></div>
                    </div>
                </a>

                <a href="/profile" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black edit icon"></i></div>
                        <div><h3>Edit Profile</h3></div>
                    </div>
                </a>

                <a href="/change-password" class="ui equal width center aligned padded stretched grid column">
                    <div class="light-gray column">
                        <div><i class="big black unlock alternate icon"></i></div>
                        <div><h3>Change Password</h3></div>
                    </div>
                </a>

                <a href="/payment-history" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black money icon"></i></div>
                        <div><h3>View Payments</h3></div>
                    </div>
                </a>

                <a href="/report" class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray column">
                        <div><i class="big black book icon"></i></div>
                        <div><h3>Report</h3></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection