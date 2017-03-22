@extends('master')

@section('title', 'Event Detail')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <div class="ui stackable grid">
                <div class="nine wide mobile nine wide tablet nine wide computer nine wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Detail</div>
                    </div>

                    <h1>Event Name #1</h1>
                    <p>By Dina the Front End Developer</p>
                </div>

                <div class="seven wide mobile seven wide tablet seven wide computer seven wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Detail Info</div>
                    </div>

                    <h5>Date and Time</h5>
                    <p>Fri, April 2017</p>
                    <p>08.00 a.m. - 02.00 p.m.</p>
                    <p>City Square KZL</p>
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

                    <form class="ui center aligned form">
                        <div class="fields">
                            <div class="six wide field">
                                <div class="ui segment">
                                    <img class="ui large rounded image" src="http://placehold.it/2160x1080">
                                    <div class="ui divider"></div>
                                    <a class="ui mini red basic button">Remove</a>
                                    <a id="js-img-adjust" class="ui mini basic teal button">Change</a>
                                    <div class="description">Recommended using image at least xpx X xpx (x:x ratio)
                                        that's no
                                        larger than xxMB
                                    </div>
                                </div>
                            </div>

                            <div class="ten wide field">
                                <div class="description">
                                    <textarea id="js-event-description">Test</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="ui divider"></div>

                        <div class="field">
                            <div class="ui center aligned basic segment">
                                <a href="admin-event-detail" class="ui basic teal button">Save</a>
                                <a class="ui basic green button">Publish</a>
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

        tinymce.init({
            selector: '#js-event-description'
        });
    </script>
@endsection