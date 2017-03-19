@if (session()->has('flash_notification.message'))

    <div class="ui small modal">
        <div class="header">Email Verification</div>
        <div class="content">
            <p>{!! session('flash_notification.message') !!}</p>
        </div>
        <div class="actions">
            <div class="ui basic blue approve button">OK</div>
        </div>
    </div>
    </div>

@endif


<script>
    $('.small.modal')
        .modal('show')
    ;
</script>