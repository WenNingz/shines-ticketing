@extends('master')

@section('title', 'All Events')

@section('navbar')
    @include('guest.navbar')
@endsection

@section('content')
    <div class="ui grid">
        <div class="one wide mobile two wide tablet four wide computer four wide large screen column">
            <div class="ui form">
                <div class="row">
                    <div class="column">
                        <h4>Type</h4>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="featured">
                                <label>Featured</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="hot">
                                <label>Hot</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="free">
                                <label>Free</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="new">
                                <label>New</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="column">
                        <h4>Dates</h4>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="today">
                                <label>Today</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="tomorrow">
                                <label>Tomorrow</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="week">
                                <label>This Week</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="weekend">
                                <label>This Weekend</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="nextWeek">
                                <label>Next Week</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="month">
                                <label>This Month</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="custom">
                                <label>Custom Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fifteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
            <form class="ui form">
                <div class="ui fluid icon input">
                    <input type="text" name="event" placeholder="Search events">
                    <i class="blue search icon"></i>
                </div>
            </form>

            <div class="ui divided items">
                <div class="item">
                    <a class="image" href="event-detail"><img src="http://placehold.it/150x120"></a>
                    <div class="content">
                        <a href="event-detail" class="header">Event Name #1
                            <span class="ui green label">New</span>
                        </a>
                        <div class="meta">
                            <span>Date & Time</span>
                        </div>
                        <div class="description">
                            <p>Location</p>
                        </div>
                        <div class="extra">
                            <p># Tickets available</p>
                            <div>
                                <i class="large right share teal alternate icon link" data-content="Share"></i>
                                <a href="event-detail">
                                    <div class="ui right floated tiny blue basic button">
                                        Buy tickets<i class="right chevron icon"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <a class="image" href="event-detail"><img src="http://placehold.it/150x120"></a>
                    <div class="content">
                        <a href="event-detail" class="header">Event Name #1
                            <span class="ui red label">Hot</span>
                        </a>
                        <div class="meta">
                            <span>Date & Time</span>
                        </div>
                        <div class="description">
                            <p>Location</p>
                        </div>
                        <div class="extra">
                            <p># Tickets available</p>
                            <div>
                                <i class="large right share teal alternate icon link" data-content="Share"></i>
                                <a href="event-detail">
                                    <div class="ui right floated tiny blue basic button">
                                        Buy tickets<i class="right chevron icon"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Pagination --}}
            <div class="ui horizontal segments">
                <div class="ui teal left aligned segment">
                    <a href="#"><i class="arrow circle outline left icon"></i> Previous</a>
                </div>
                <div class="ui teal center aligned segment">
                    <p>1 of 1</p>
                </div>
                <div class="ui teal right aligned segment">
                    <a href="">Next <i class="arrow circle outline right icon"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.icon.link')
            .popup({
                variation: "mini inverted"
            })
        ;
    </script>
@endsection