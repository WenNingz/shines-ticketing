@extends('master')

@section('title', 'Payment Details')

@section('navbar')
    @include('attendee.common.navbar')
@endsection

@section('content')
    <div class="ui stackable grid">
        <div class="one wide mobile three wide tablet three wide computer three wide large screen column">
            <div class="ui fluid secondary vertical menu">
                @include('attendee.common.sidebar')
            </div>
        </div>

        <div class="fifteen wide mobile thirteen wide tablet thirteen wide computer thirteen wide large screen column">
            <h3 class="ui teal dividing header">
                Account Information
            </h3>

            <div class="ui stackable grid">
                <div class="sixteen wide mobile fourteen wide tablet twelve wide computer twelve wide large screen column">
                    <h4 class="ui dividing header">
                        Payment Option
                    </h4>

                    <a href=""><i class="teal add circle icon"></i> Add payment option</a>

                    <table class="ui very basic table">
                        <tbody>
                        <tr>
                            <td><i class="teal large paypal card icon"></i></td>
                            <td>Paypall Card</td>
                        </tr>
                        <tr>
                            <td><i class="teal large visa icon"></i></td>
                            <td>Visa Card</td>
                        </tr>
                    </table>

                    <form method="GET" action="profile" class="ui center aligned form segment">
                        <h4 class="ui dividing header">
                            Add Payment
                        </h4>

                        <img src="{{asset('img/paypal.png')}}">
                        <div class="ui horizontal divider">OR</div>
                        <img src="{{asset('img/mastercard.png')}}">
                        <img src="{{asset('img/visa.png')}}">

                        <div class="fields">
                            <div class="seven wide field">
                                <label>Card Number</label>
                                <input type="text" name="card[number]" maxlength="16" placeholder="Card #">
                            </div>

                            <div class="three wide field">
                                <label>CVC</label>
                                <input type="text" name="card[cvc]" maxlength="3" placeholder="CVC">
                            </div>

                            <div class="six wide field">
                                <label>Expiration</label>
                                <div class="two fields">
                                    <div class="field">
                                        <select class="ui fluid search dropdown" name="card[expire-month]">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="card[expire-year]" maxlength="4" placeholder="Year">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="two wide field">
                                <div class="ui fluid basic red button">Cancel</div>
                            </div>
                            &nbsp;
                            <div class="two wide field">
                                <div class="ui fluid basic teal button">Add</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection