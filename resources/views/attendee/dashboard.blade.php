@extends('master')

@section('title', 'Dashboard')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Dashboard
            </h3>

            <h4 class="ui dividing header">
                Purchased Ticket
            </h4>
            <div class="ui  middle aligned divided relaxed list">
                @foreach($purchases as $purchase)
                    <div class="item">
                        <div class="content">
                            <div class="ui middle aligned divided horizontal list">
                                <div class="item">
                                    <div class="ui header">{{ $purchase->id }}</div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <a href="/purchase-details/{{ $purchase->id }}" class="ui header link">{{ $purchase->event->name }}</a>
                                        {{ $purchase->event->date }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right floated content">
                            <a href="/purchase-details/{{ $purchase->id }}" class="ui right floated icon link">
                                View ticket
                                <i class="angle right icon"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                {{ $purchases->links('layout.semantic-paginate') }}
            </div>
        </div>
    </div>
@endsection