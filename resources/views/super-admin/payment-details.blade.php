@extends('master')

@section('title', 'Ticket Details')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')

    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Payment Details
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <div class="ui message">
                        <div class="ui centered blue header">{{ $purchase->event->name }}</div>
                        <div class="ui divider"></div>
                        <div class="ui two column doubling stackable grid">
                            <div class="ui column">
                                <div class="content">
                                    <p><b>Attendee :</b>
                                        {{ $purchase->user->first_name . ' ' . $purchase->user->last_name }}
                                    </p>
                                    <p><b>Payment Date : </b>{{ $purchase->created_at->toDayDateTimeString() }}</p>
                                </div>
                            </div>
                            <div class="ui column">
                                <div class="content">
                                    @php
                                        $qty = 0;
                                        $payment = 0.00;
                                        foreach($purchase->items as $item) {
                                            $qty = $qty + $item->passCount();
                                            foreach ($item->passes as $pass) {
                                                $payment = $payment + $pass->price;
                                            }
                                        }
                                    @endphp
                                    <p><b>Total Qty :</b> {{ $qty }}</p>
                                    <p><b>Total Payment :</b> ${{ number_format((float)$payment, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <div class="ui list">
                        @foreach($purchase->items as $item)
                            <div class="item">
                                <i class="ticket icon"></i>
                                <div class="content">
                                    <div class="header">{{ $item->ticket->name }}</div>
                                    <div class="description">{{ $item->ticket->description }}</div>
                                    <div class="list">
                                        @foreach($item->passes as $pass)
                                            <div class="item">
                                                <i class="check circle outline icon"></i>
                                                <div class="content">
                                                    <div class="header">{{ $pass->number }}</div>
                                                    <div class="description">${{ $pass->price }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection