<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
</head>
<body>
<div class="ui text container">
    <div>Hi {{ $user->first_name . ' ' . $user->last_name }}, this is your purchase confirmation for <a
                href="http://shines.app/view-event/" . {{ $event->id }}>{{ $event->name }}</a></div>
    <div class="ui divider"></div>

    <div class="ui grey segment">
        <div class="ui header">
            Order Summary
            <span class="sub header">{!! $purchase->created_at !!}</span>
        </div>
        <table class="ui very basic collapsing celled table">
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            <tr>
                <th>Type</th>
            </tr>
            <tr>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchase->items as $item)
                <tr>
                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                </tr>
                <tr>
                    <td>{{ $item->ticket->name }}</td>
                </tr>
                <tr>
                    <td>{{ $item->passCount() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="ui divider"></div>
    <div class="ui header">About this event</div>
    <div class="ui basic segment">
        <div><i class="wait icon"></i>{{ $event->date }}</div>
        <div><i class="map pin icon"></i>{{ $event->venue }}</div>
    </div>

    <div class="ui divider"></div>
    <div><a href="http://shines.app/login">Log in</a> to access tickets and manage your orders</div>

    <div class="ui divider"></div>
    <div class="footer">
        <div class="ui center aligned basic inverted segment">
            <p>This email was sent to {{ $user->email }}</p>
            <p>&copy; 2017 Shines Services. All Rights Reserved.</p>
        </div>
    </div>

</div>

</body>
</html>