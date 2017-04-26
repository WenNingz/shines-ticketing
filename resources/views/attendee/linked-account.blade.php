@extends('master')

@section('title', 'Link Account')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile five wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>
        <div class="fifteen wide mobile eleven wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <h4 class="ui dividing header">
                        Linked Account
                    </h4>

                    <table class="ui very basic table">
                        <tbody>
                        @foreach($social_accounts as $account)
                            <tr>
                                <td><i class="large teal check circle outline icon"></i></td>
                                @if($account->provider == 'facebook')
                                    <td><i class="large blue facebook icon"></i></td>
                                @elseif($account->provider == 'google')
                                    <td><i class="large red google icon"></i></td>
                                @elseif($account->provider == 'twitter')
                                    <td><i class="large teal twitter icon"></i></td>
                                @endif

                                @if($account->provider == 'facebook')
                                    <td>Facebook</td>
                                @elseif($account->provider == 'google')
                                    <td>Google+</td>
                                @elseif($account->provider == 'twitter')
                                    <td>Twitter</td>
                                @endif
                                <td class="right aligned">
                                    <b><a href="#" class="ui red text disconnect link" data-action="disconnect"
                                          data-value="{{ $account->id }}">Disconnect</a></b>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.disconnect').click(function () {
            $.ajax({
                url: '/delete',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    account_id: $(this).attr('data-value'),
                    action: $(this).attr('data-action')
                },
                beforeSend: function (jqXHR, settings) {
                    console.log(settings.data);
                    return settings;
                },
                success: function (data, textStatus, jqXHR) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection