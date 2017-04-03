<a href="/dashboard" class="@if($_active == 'dashboard') active @endif item">
    Home
</a>

<a href="event-list" class="@if($_active == 'event-list') active @endif item">
    Events
</a>
<div class="menu">
    <a href="event-list" class="@if($_active == 'event-list') active @endif item">Event List</a>
    <a href="sync-event" class="@if($_active == 'sync-event') active @endif item">Sync Event</a>
</div>

<a href="manage-attendee" class="@if($_active == 'manage-attendee') active @endif item">
    Attendees
</a>

<a href="ticket-list" class="item">
    Support
</a>
<div class="menu">
    <a href="/ticket-list" class="@if($_active == 'ticket-list') active @endif item">Ticket List</a>
    <a href="/my-tickets" class="@if($_active == 'my-tickets') active @endif item">
        My Ticket
        <span class="ui mini red label">2</span>
    </a>
</div>

<a href="/profile" class="item">
    Account Setting
</a>
<div class="menu">
    <a href="/profile" class="@if($_active == 'profile') active @endif item">Personal Information</a>
    <a href="/change-password" class="@if($_active == 'change-password') active @endif item">Password</a>
</div>

<a href="admin-payments" class="@if($_active == 'admin-payments') active @endif item">
    Payment
</a>

<a href="/logout" class="item">
    Log Out
</a>
