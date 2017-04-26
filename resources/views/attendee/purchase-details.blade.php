@extends('master')

@section('title', 'Purchase Details')

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
            <div class="ui teal dividing header">
                <div class="content">Ticket Details</div>
            </div>
            <div class="ui four stackable doubling cards">
                @foreach($purchase->items as $item)
                    @foreach($item->passes as $pass)
                        <div class="card">
                            <div class="content">
                                <a class="header">{{ $pass->item->ticket->name }}</a>
                                <div class="meta">{{ $pass->number }}</div>
                            </div>
                            <div class="extra content">
                                <a href="/print-ticket/{{ $pass->id }}"
                                   class="ui mini basic green button">
                                    Print Ticket
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection