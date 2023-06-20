@component('mail::message')
# Ticket In Progress

Dear <strong> {{$customer->name}}</strong>,<br>

Your ticket has been followed_by {{$user->first_name}}. use the link below to get status.

@component('mail::button', ['url' => env('FRONTEND_BASE_URL') .'customer/ticket-search?ticket='.$ticket->ticket_number])
Check status
@endcomponent
Thank you,<br>
Sincerely,<br>
@endcomponent
