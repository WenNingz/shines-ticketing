@extends('master')

@section('title', 'Report')

@section('navbar')
    @include('super-admin.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui teal fluid secondary vertical menu">
                @include('super-admin.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Report
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer twelve wide large screen column">
                    <form method="GET" action="/report" onsubmit="$('.ui.submit.button').prop('disabled', true)"
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
                                <input name="start_date" type="text" class="datepicker" placeholder="Date From">
                            </div>
                            <div class="required field">
                                <label>Date To</label>
                                <input name="end_date" type="text" class="datepicker" placeholder="Date To">
                            </div>
                        </div>

                        <div class="field">
                            <label>Report Result</label>
                            <div class="fields">
                                <div class="field">
                                    <button type="submit" class="ui mini basic green submit button">Excel</button>
                                </div>
                                <div class="field">
                                    <button type="submit" class="ui mini basic green submit button">CSV</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    },
                },
                onFailure: function () {
                    $('.ui.submit.button').prop('disabled', false);
                    return false;
                }
            });
    </script>
@endsection