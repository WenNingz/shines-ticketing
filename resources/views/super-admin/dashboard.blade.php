@extends('master')

@section('title', 'Dashboard')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Dashboard
            </h3>

            <div class="ui four column center aligned doubling stackable grid">
                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="orange column">
                            <div><i class="big calendar outline icon"></i></div>
                            <div class="ui horizontal divider"></div>
                            <div><b>TOTAL EVENTS</b></div>
                        </div>
                        <div class="box column">
                            1024
                        </div>
                    </div>
                </div>

                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="yellow column">
                            <div><i class="big thumbs outline up icon"></i></div>
                            <div><b>FEATURED</b></div>
                        </div>
                        <div class="box column">
                            Black
                        </div>
                    </div>
                </div>

                <div class="ui equal width center aligned padded grid stretched  column">
                    <div class="light-gray row">
                        <div class="teal column">
                            <div><i class="big star icon"></i></div>
                            <div><b>FREE</b></div>
                        </div>
                        <div class="box column">
                            Black
                        </div>
                    </div>
                </div>

                <div class="ui equal width center aligned padded grid stretched column">
                    <div class="light-gray row">
                        <div class="purple column">
                            <div><i class="big ticket icon"></i></div>
                            <div><b>TICKETS SOLD</b></div>
                        </div>
                        <div class="box column">
                            Black
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection