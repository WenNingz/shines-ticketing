@extends('master')

@section('title', 'Edit Event')

@section('navbar')
    @include('admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('admin.common.sidebar')
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

                @if($event->tags()->count() > 0)
                    <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                        <div class="ui inverted dividing"></div>
                        <span>Tags: </span>
                        @foreach($event->tags as $tag)
                            <a class="ui black basic label">{{ $tag->name}}</a>
                        @endforeach
                    </div>
                @endif

                <div class="sixteen wide mobile sixteen wide tablet sixteen wide computer sixteen wide large screen column">
                    <div class="ui teal dividing header">
                        <div class="content">Event Description</div>
                    </div>

                    <form method="POST" action="/edit-event/{{ $event->id }}" enctype="multipart/form-data"
                          onsubmit="$('.ui.submit.button').prop('disabled', true)" class="ui center aligned form">
                        {{ csrf_field() }}

                        <input type="hidden" name="image" id="hidden-input"
                               value="{{ old('image') == null ? asset($event->image_ori):old('image') }}">
                        <input type="hidden" name="image_300" id="hidden-input-300"
                               value="{{ old('image_300') == null ? asset($event->image_card):old('image_300') }}">

                        <div class="fields">
                            <div class="six wide field">
                                <div class="ui segment">
                                    <img id='image-view' class="ui large rounded image"
                                         onerror="this.src='{{ asset('img/noImage.png') }}'"
                                         src="{{ old('image') == null ? asset($event->image_ori):old('image') }}">

                                    <input accept="image/*" type="file" name="image_upload" id="invisible-input"
                                           style="display: none">
                                    <div class="ui divider"></div>

                                    <label for="invisible-input" class="ui mini right floated basic teal icon button">
                                        <i class="folder open outline icon"></i> Browse
                                    </label>

                                    <div class="description">Recommended using image at least 800px X 400px (2:1 ratio)</div>
                                </div>
                            </div>

                            <div class="ten wide field">
                                <div class="description">
                                    <textarea name="description"
                                              id="tiny">{{ $event->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="publish" id="publish" value="false">
                        <input type="hidden" name="reject" id="reject" value="false">

                        <div class="ui divider"></div>

                        <div class="field">
                            <div class="ui center aligned basic segment">
                                <button type="submit" class="ui basic teal mini submit button">Save</button>
                                <button type="submit" class="ui basic green button mini submit publish">Save & Publish
                                </button>
                                <button type="submit" class="ui basic red button mini submit reject">Reject</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#invisible-input').change(function () {
            var progress_bar = $('.ui.progress');
            var data = new FormData();
            var image = $('#image-view');

            var file = $('#invisible-input')[0].files[0];
            /*var sizeKB = file.size / 10240;

             if (sizeKB > 10240) {
             var limitMessage = $("#js-image-limit-error-message");
             $('html, body').animate({
             scrollTop: limitMessage.offset().top
             }, 200);
             limitMessage.removeClass('hidden');
             return false;
             }*/

            data.append('files', file);
            data.append('_token', '{{ csrf_token() }}');
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            progress_bar.progress({
                                percent: percentComplete,
                            });
                        }
                    }, false);
                    return xhr;
                },

                url: '/image',
                type: 'POST',
                contentType: false,
                processData: false,
                data: data,

                success: function (data) {
                    console.log(data);
                    image.attr('src', data.image_path);
                    image.show();
                    $('#hidden-input').val(data.image_path);
                    $('#hidden-input-300').val(data.image_300_path);
                },
                error: function (data) {
                    console.log(data);
                }

            })
        });

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
    </script>
@endsection