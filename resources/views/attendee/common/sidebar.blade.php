<a href="/dashboard" class="@if($_active == 'dashboard') active @endif item">
    Home
</a>
<a href="/my-tickets" class="@if($_active == 'my-tickets') active @endif item">
    Support
</a>

<a href="/profile" class="item">
    Account Setting
</a>
<div class="menu">
    <a href="/profile" class="@if($_active == 'profile') active @endif item">Personal Information</a>
    <a href="/change-password" class="@if($_active == 'change-password') active @endif item">Password</a>
    <a href="linked-account" class="@if($_active == 'linked-account') active @endif item">Linked Accounts</a>
    <a href="payments" class="@if($_active == 'payments') active @endif item">Payments</a>
</div>

<a href="/logout" class="item">
    Log Out
</a>
