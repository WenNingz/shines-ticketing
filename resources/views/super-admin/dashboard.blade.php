@extends('master')

@section('title', 'Dashboard')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Dashboard
            </h3>

            <div class="ui four column center aligned stackable grid">
                <div class="column">
                    <div class="ui one column padded grid">
                        <div class="orange column">
                            <i class="big calendar outline icon"></i>
                            <p><b>TOTAL EVENT</b></p>
                        </div>
                        <div class="light-gray column">
                            <b class="text orange">80</b>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui one column padded grid">
                        <div class="yellow column">
                            <i class="big thumbs outline up icon"></i>
                            <p><b>FEATURED</b></p>
                        </div>
                        <div class="light-gray column">
                            <b class="text yellow">25</b>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui one column padded grid">
                        <div class="teal column">
                            <i class="big star icon"></i>
                            <p><b>FREE</b></p>
                        </div>
                        <div class="light-gray column">
                            <b class="text teal">55</b>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui one column padded grid">
                        <div class="purple column">
                            <i class="big ticket icon"></i>
                            <p><b>TICKETS SOLD</b></p>
                        </div>
                        <div class="light-gray column">
                            <b class="text purple">1012</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection