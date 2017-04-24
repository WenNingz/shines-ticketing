<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&subset=latin');

        * {
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: 600;
        }

        table {
            border-collapse: collapse;
        }

        td {
            position: relative;
            border: 2px solid black;
            vertical-align: top;
            text-align: right;
            padding: 40px 10px 10px 10px;
        }
    </style>
</head>
<body>
@foreach($passes as $pass)
    <table>
        <tr>
            <td colspan="2">
                <h2>{{ $pass->item->ticket->event->name }}</h2>
            </td>
            <td style="padding: 10px">
                <div class="visible-print text-center">
                    <img class="ui fluid image"
                         src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->margin(0)->size(140)->generate($pass->number)) !!} ">
                </div>
            </td>
        </tr>
        <tr>
            <td rowspan="2">
                {{ Carbon\Carbon::parse($pass->item->ticket->event->date)->format('l, jS \\of F Y \\a\\t h:i:s A') }}
            </td>
            <td rowspan="2">
                {{ $pass->item->ticket->event->venue }}
            </td>
            <td style="text-align: center">
                {{ $pass->item->purchase->user->first_name . ' ' . $pass->item->purchase->user->last_name  }}
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                {{ $pass->item->ticket->name }}
            </td>
        </tr>
    </table>
@endforeach
</body>
</html>
