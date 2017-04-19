@extends('master')

@section('title', 'Event Details')

@section('navbar')
    @if(auth()->check())
        @if(auth()->user()->hasRole('super-admin'))
            @include('super-admin.common.navbar')
        @elseif(auth()->user()->hasRole('admin'))
            @include('admin.common.navbar')
        @elseif(auth()->user()->hasRole('attendee'))
            @include('attendee.common.navbar')
        @endif
    @else
        @include('guest.navbar')
    @endif
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
            <div class="ui teal dividing header">
                <div class="content">Free Event</div>
            </div>
            <div class="ui text container">
                <h1 class="ui blue header">{{ $event->name }}
                    <div class="sub header"></div>
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
            <form method="POST" action="/buy-tickets/{{ $event->id }}"
                  class="ui form @if(sizeof($errors->all()) > 0)) error @endif">
                {{ csrf_field() }}
                @include('layout.errors')
                <table class="ui unstackable small compact table">
                    <thead>
                    <tr>
                        <th>Ticket Type</th>
                        <th>Remaining</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($event->tickets as $ticket)
                        <tr>
                            <td>
                                <h5 class="ui header">{{ $ticket->name }}
                                    <div class="sub header">{{ $ticket->description }}</div>
                                </h5>
                            </td>
                            <td>{{ $ticket->available }} Tickets</td>
                            <td>${{ $ticket->price }}</td>
                            <td>
                                @if($ticket->available > 0)
                                    @if($ticket->price == '0.00')
                                        <select name="qty[{{ $ticket->id }}]" class="ui fluid dropdown">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    @else
                                        <select name="qty[{{ $ticket->id }}]" class="ui fluid dropdown">
                                            @for($available = 0; $available <= 10 && $available <= $ticket->available; $available++)
                                                <option value="{{ $available }}">{{ $available }}</option>
                                            @endfor
                                        </select>
                                    @endif
                                @else
                                    Sold Out
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
                @if($event->image_ori != null)
                    <img class="ui centered image" src="{{ asset($event->image_ori) }}">
                    <div class="ui divider"></div>
                @endif
                {!! $event->description !!}
                @if($event->tags()->count() > 0)
                    <div class="ui divider">
                        <span>Tags: </span>
                        @foreach($event->tags as $tag)
                            <a class="ui black basic label">{{ $tag->name}}</a>
                        @endforeach
                    </div>

                @endif
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