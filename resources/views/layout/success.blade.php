@if (session('status'))
    <div class="ui positive message">
        @if(session('header'))
            <div class="header">{{ session('header') }}</div>
        @endif
        <p>{{ session('status') }}</p>
    </div>
@endif