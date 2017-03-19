@if(sizeof($errors->all() > 0))
    <div class="ui error message">
        <div class="header">
            There were some errors with your submission
        </div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif