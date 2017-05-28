@extends('master')

@section('title', 'Report')

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
                Report
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <form id="form_report" method="POST" action="/report"
                          class="ui form @if(sizeof($errors->all()) > 0)) error @endif">
                        {{ csrf_field() }}

                        @include('layout.errors')

                        <div class="field">
                            <label>Select Events</label>
                            <select name="type" class="ui fluid dropdown" id="select">
                                <option value="all">All Events</option>
                                <option value="live">Live Events</option>
                                <option value="completed">Completed Events</option>
                            </select>
                        </div>

                        <div class="two fields">
                            <div class="required field">
                                <label>Date From</label>
                                <input name="start_date" type="text" class="datepicker" placeholder="Date From"
                                       value="{{$start_date}}">
                            </div>
                            <div class="required field">
                                <label>Date To</label>
                                <input name="end_date" type="text" class="datepicker" placeholder="Date To"
                                       value="{{$end_date}}">
                            </div>
                        </div>

                        <div class="field">
                            <label>Report Result</label>
                            <div class="fields">
                                <div class="field">
                                    <button type="submit" class="ui mini basic blue submit button"
                                            onclick="$('#form_report').attr('method', 'GET')">View
                                    </button>
                                </div>
                                <div class="field">
                                    <button type="submit" class="ui mini basic green submit button"
                                            onclick="$('#form_report').attr('method', 'POST')">Save as Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <h4>Result from {{$start_date}} to {{$end_date}}</h4>
                    <table class="ui blue small compact celled structured table">
                        <thead>
                        <tr>
                            <th rowspan="3">Event Name</th>
                            <th rowspan="3">Event Date</th>
                            <th colspan="4">Sales</th>
                        </tr>
                        <tr>
                            <th rowspan="2">Payment ID</th>
                            <th rowspan="2">Date</th>
                            <th colspan="2">Ticket</th>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <th>Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            @php $event_first = true; @endphp
                            @foreach($event->purchases as $purchase)
                                @php $purchase_first = true; @endphp
                                @foreach($purchase->items as $item)
                                    @php $item_first = true; @endphp
                                    @foreach($item->passes as $pass)
                                        <tr>
                                            @if($event_first)
                                                <td rowspan="{{$event->countRows()}}">{{$event->name}}</td>
                                                <td rowspan="{{$event->countRows()}}">{{ $event->date }}</td>
                                                @php $event_first = false; @endphp
                                            @endif
                                            @if($purchase_first)
                                                <td rowspan="{{$purchase->countRows()}}">{{ $purchase->purchase_id }}</td>
                                                <td rowspan="{{$purchase->countRows()}}">{{ $purchase->created_at }}</td>
                                                @php $purchase_first = false; @endphp
                                            @endif
                                            @if($item_first)
                                                <td rowspan="{{$item->passes()->count()}}">{{ $item->ticket->name }}</td>
                                                @php $item_first = false; @endphp
                                            @endif
                                            <td>{{ $pass->number }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#select')
            .dropdown();
        ;

        $(function () {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });

        $('.ui.form')
            .form({
                fields: {
                    start_date: {
                        identifier: 'start_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The date from field is required.'
                            }]
                    },
                    end_date: {
                        identifier: 'end_date',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'The date to from field is required.'
                            }]
                    }
                }
            });
    </script>
@endsection