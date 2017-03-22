@extends('master')

@section('title', 'Sync Event')

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
                Sync Event
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <a class="ui basic green icon button">Select All</a>
                    <a class="ui basic teal icon button">Save</a>
                    <a class="ui right floated basic blue icon button"><i class="refresh icon"></i>Sync</a>
                </div>

                <div class="ui middle aligned animated divided list">
                    <div class="item">
                        <div class="ui basic segment">
                            <h4 class="header">Event Name #1</h4>
                            <p>Date & Time</p>
                            <a href="#">Edit</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ui basic segment">
                            <h4 class="header">Event Name #2</h4>
                            <p>Date & Time</p>
                            <a href="#">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Concept: Use hidden checkbox to select multiple events--}}