@extends('master')

@section('title', 'Payment Details')

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
                Payment Transaction
            </h3>

            <table class="ui unstackable celled table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @if($purchases->count() == 0)
                    <tr colspan="4">
                        <td>No purchased data</td>
                    </tr>
                @else
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>
                                <div class="ui small header">{{ $purchase->created_at->format('j') }}
                                    <div class="sub header">{{ $purchase->created_at->format('M y') }}</div>
                                </div>
                            </td>
                            <td>{{ $purchase->created_at->format('h:i:s A') }}</td>
                            <td>{{ $purchase->event->name }}</td>
                            <td>
                                <a href="/payment-details/{{ $purchase->id }}"
                                   class="ui mini fluid basic blue button">Details</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">
                        {{ $purchases->links('layout.semantic-paginate') }}
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection