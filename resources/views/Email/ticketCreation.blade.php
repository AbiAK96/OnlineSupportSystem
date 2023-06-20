@component('mail::message')
# Ticket Confirmation

Dear <strong> {{$customer->name}}</strong>,<br>

You have created new ticket. Your ticket referece number : {{$ticket->ticket_number}},use the link below to get status.

@component('mail::button', ['url' => env('FRONTEND_BASE_URL') .'customer/ticket/serach?ticket='.$ticket->ticket_number])
Check status
@endcomponent
Thank you,<br>
Sincerely,<br>
@endcomponent
