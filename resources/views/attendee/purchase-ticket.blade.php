@extends('master')

@section('title', 'Print Ticket')

@section('style')
    <style>
        html, body {
            min-width: 800px;
        }

        .ui.celled.grid > .row > .column {
            border: 2px solid black;
        }

        .ui.celled.grid {
        }
    </style>
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
            <h3 class="ui teal dividing header">
                Print Ticket
            </h3>
            <div class="ui text container">
                <h2>Here are your ticket</h2>
                <div class="ui celled grid">
                    <div class="stretched row">
                        <div class="twelve wide column">
                            <div class="ui top left attached mini label">Event</div>
                            <span class="ui right aligned header">{{ $pass->item->ticket->event->name }}</span>
                        </div>
                        <div class="four wide center aligned column">
                            <div class="visible-print text-center">
                                <img class="ui fluid image"
                                     src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->margin(0)->size(140)->generate($pass->number)) !!} ">
                            </div>
                        </div>
                    </div>
                    <div class="stretched row">
                        <div class="six wide column">
                            <div class="ui top left attached mini label">Date Time</div>
                            <span class="ui right aligned tiny header">
                                {{ Carbon\Carbon::parse($pass->item->ticket->event->date)->format('l, jS \\of F Y \\a\\t h:i:s A') }}
                            </span>
                        </div>
                        <div class="six wide column">
                            <div class="ui top left attached mini label">Location</div>
                            <span class="ui right aligned tiny header">{{ $pass->item->ticket->event->venue }}</span>
                        </div>
                        <div class="four wide center aligned column" style="padding: 0px;">
                            <div class="ui padded grid">
                                <div class="row" style="padding: 0px;">
                                    <div class="column">
                                        <div class="ui top left attached mini label">Name</div>
                                        <h5>
                                            {{ $pass->item->purchase->user->first_name . ' ' . $pass->item->purchase->user->last_name  }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                        <div class="ui top left attached mini label">Ticket Type</div>
                                        <h5>{{ $pass->item->ticket->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection