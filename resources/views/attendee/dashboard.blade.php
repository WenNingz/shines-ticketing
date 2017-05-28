@extends('master')

@section('title', 'Home')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Dashboard
            </h3>

            @php
                $dashboard = \Route::current()->getName() == 'dashboard';
                $refund = \Route::current()->getName() == 'refund';
            @endphp

            <div class="ui secondary pointing menu">
                <a href='/dashboard' class="@if($dashboard) active @endif item">
                    Purchased Tickets
                </a>
                <a href='/refund' class="@if($refund) active @endif item">
                    Refunding Tickets
                </a>
            </div>

            <div class="ui  middle aligned divided relaxed list">
                @if($dashboard)
                    @if($purchases->isEmpty())
                        <div class="item">
                            <div class="content">No purchased ticket</div>
                        </div>
                    @else
                        @foreach($purchases as $purchase)
                            <div class="item">
                                <div class="content">
                                    <div class="ui middle aligned divided horizontal list">
                                        <div class="item">
                                            <div class="ui header">{{ $purchase->id }}</div>
                                        </div>
                                        <div class="item">
                                            <div class="content">
                                                <a href="/purchase-details/{{ $purchase->id }}"
                                                   class="ui header link">{{ $purchase->event->name }}</a>
                                                {{ $purchase->event->date }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right floated content">
                                    <a href="/purchase-details/{{ $purchase->id }}" class="ui right floated icon link">
                                        View purchase
                                        <i class="angle right icon"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
                @if($refund)
                    @if($refunds->isEmpty())
                        <div class="item">
                            <div class="content">No refunding ticket</div>
                        </div>
                    @else
                        @foreach($refunds as $refund)
                            <div class="item">
                                <div class="content">
                                    <div class="ui middle aligned divided horizontal list">
                                        <div class="item">
                                            <div class="ui header">{{ $refund->id }}</div>
                                        </div>
                                        <div class="item">
                                            <div class="content">
                                                <a href="/purchase-details/{{ $refund->id }}"
                                                   class="ui header link">{{ $refund->event->name }}</a>
                                                {{ $refund->event->date }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right floated content">
                                    <a href="/purchase-details/{{ $refund->id }}" class="ui right floated icon link">
                                        View purchase
                                        <i class="angle right icon"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>

            <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                {{ $purchases->links('layout.semantic-paginate') }}
            </div>
        </div>
    </div>
@endsection