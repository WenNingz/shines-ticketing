@extends('master')

@section('title', 'Edit Event')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            @include('layout.success')
            <div class="ui stackable grid">
                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Detail</div>
                    </div>

                    <h1>{{ $event->name }}</h1>
                    <p>By Dina the Front End Developer</p>
                </div>

                <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Detail Info</div>
                    </div>

                    <h5>Date and Time</h5>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('l, j F Y') }}</p>
                    <p>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                    <p>{{ $event->venue }}</p>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui inverted dividing"></div>
                    <span>Share with friends: </span>
                    <i class="teal circular facebook f icon link" data-content="Facebook"></i>
                    <i class="teal circular google icon link" data-content="Google+"></i>
                    <i class="teal circular twitter icon link" data-content="Twitter"></i>
                </div>

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Description</div>
                    </div>

                    <form method="POST" action="/edit-event/{{ $event->id }}"
                          onsubmit="$('.ui.submit.button').prop('disabled', true)" class="ui center aligned form">
                        {{ csrf_field() }}

                        <div class="fields">
                            <div class="six wide field">
                                <div class="ui segment">
                                    <img class="ui large rounded image" src="{{ asset($event->image) }}">
                                    <div class="ui divider"></div>
                                    <a class="ui mini red basic button">Remove</a>
                                    <a id="js-img-adjust" class="ui mini basic teal button">Change</a>
                                    <div class="description">Recommended using image at least xpx X xpx (x:x ratio)
                                        that's no larger than xxMB
                                    </div>
                                </div>
                            </div>

                            <div class="ten wide field">
                                <div class="description">
                                    <textarea name="description"
                                              id="js-event-description">{{ $event->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="publish" id="publish" value="false">
                        <input type="hidden" name="reject" id="reject" value="false">

                        <div class="ui divider"></div>

                        <div class="field">
                            <div class="ui center aligned basic segment">
                                <button type="submit" class="ui basic teal submit button">Save</button>
                                <button type="submit" class="ui basic green button submit publish">Save & Publish
                                </button>
                                <button type="submit" class="ui basic red button submit reject">Reject</button>
                            </div>
                        </div>

                        {{--Modal--}}
                        <div class="ui small modal">
                            <i class="close icon"></i>
                            <div class="header">
                                Change Image
                                <div class="ui mini right floated basic teal icon button">
                                    <i class="folder open outline icon"></i> Browse
                                </div>
                            </div>
                            <div class="image content">
                                <div class="ui fluid image">
                                    <img src="http://placehold.it/2160x1080">
                                </div>
                            </div>
                            <div class="actions">
                                <div class="ui mini basic red cancel button">
                                    Cancel
                                </div>
                                <div class="ui mini basic teal approve button">
                                    Save
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.ui.small.modal')
            .modal('attach events', '#js-img-adjust', 'show')
        ;

        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;

        $('.publish').on('click', function () {
            $('#publish').val('true')
        });

        $('.reject').on('click', function () {
            $('#reject').val('true')
        });

        tinymce.init({
            selector: '#js-event-description'
        });
    </script>
@endsection