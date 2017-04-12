@extends('master')

@section('title', 'Event Details')

@section('navbar');
@include('guest.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Free Event</div>
            </div>
            <div class="ui text container">
                <h1 class="ui blue header">{{ $event->name }}
                    <div class="sub header">By Dina the Front End Developer</div>
                </h1>
                <p>{{ \Carbon\Carbon::parse($event->date)->format('l, j F Y') }}</p>
                <p>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                <p>{{ $event->venue }}</p>
            </div>
        </div>

        <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Ticket Info</div>
            </div>
            <form method="POST" action="/buy-tickets/{{ $event->id }}">
                {{ csrf_field() }}
                <table class="ui unstackable table">
                    <thead>
                    <tr>
                        <th>Ticket Type</th>
                        <th>Price</th>
                        <th>Remaining</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($event->tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->name }}</td>
                            <td>${{ $ticket->price }}</td>
                            <td>{{ $ticket->available }} Tickets</td>
                            <td>
                                @if($ticket->price == '0.00')
                                    <select name="qty_{{ $ticket->id }}" class="ui fluid dropdown">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                    {{--<input type="number" name="qty_{{ $ticket->id }}">--}}
                                @else
                                    <select name="qty_{{ $ticket->id }}" class="ui fluid dropdown">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">
                            <button type="submit" class="ui right floated mini blue basic button">Buy tickets</button>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>

        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <span>Share with friends: </span>
            <i class="teal circular facebook f icon link" data-content="Facebook"></i>
            <i class="teal circular google icon link" data-content="Google+"></i>
            <i class="teal circular twitter icon link" data-content="Twitter"></i>

        </div>

        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Description</div>
            </div>
            <div align="justify" class="ui text container">
                @if($event->image != null)
                    <img class="ui centered image" src="{{ asset($event->image) }}">
                @endif
                {!! $event->description !!}
            </div>
        </div>
    </div>

    <script>
        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;

        $('.ui.dropdown')
            .dropdown()
        ;


    </script>
@endsection