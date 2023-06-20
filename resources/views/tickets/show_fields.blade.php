<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Customer Name:') !!}
    <p>{{ $ticket->customer->name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $ticket->description }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('ticket_number', 'Ticket number:') !!}
    <p>{{ $ticket->ticket_number }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $ticket->status }}</p>
</div>
@if ($ticket->followed_by != null) {
<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('followed_by', 'Followed by:') !!}
    <p>{{ $ticket->user->first_name }}</p>
</div>
} @else
<div class="col-sm-12">
{!! Form::label('status', 'Status:') !!}
    <p>Not assigned</p>
</div>
@endif