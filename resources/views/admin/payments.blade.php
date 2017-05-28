@extends('master')

@section('title', 'Payments List')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Payment Transaction
            </h3>

            <table class="ui unstackable celled table">
                <thead>
                <tr>
                    <th>Event</th>
                    <th>Name</th>
                    <th>Payment Date</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @if($purchases->count() == 0)
                    <tr colspan="5">
                        <td>No data</td>
                    </tr>
                @else
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->event->name }}</td>
                            <td>{{ $purchase->user->first_name . ' ' . $purchase->user->last_name }}</td>
                            <td>{{ $purchase->created_at->toDayDateTimeString() }}</td>
                            <td>
                                <a href="/payment-details/{{ $purchase->id }}" class="ui mini fluid basic blue button">Details</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        {{ $purchases->links('layout.semantic-paginate') }}
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection