<div class="table-responsive">
    <table class="table table-bordered" id="tickets-table">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Description</th>
            <th>Ticket Number</th>
            <th>Status</th>
            <th>Followed By</th>

            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->ticket_number }}</td>
                <td>
                    @if($ticket->status == "New")
                    <small class="label bg-blue">{{ $ticket->status }}</small>
                    @elseif($ticket->status == "Pending")
                    <small class="label bg-red">{{ $ticket->status }}</small>
                    @elseif($ticket->status == "Ongoing")
                    <small class="label bg-yellow">{{ $ticket->status }}</small>
                    @elseif($ticket->status_id == "Completed")
                    <small class="label bg-green">{{ $ticket->status }}</small>
                    @endif</td>
                <td>
                    @if($ticket->followed_by == null)
                   not assinged
                    @else
                    {{ $ticket->user->first_name }}
                    @endif
                </td>
                
                <td width="120">
                    @if (auth()->user()->role_id === 1) 
                    {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tickets.show', [$ticket->id]) }}" title="View"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tickets.edit', [$ticket->id]) }}" title="Assign"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @else
                    <div class='btn-group'>
                        <a href="{{ route('tickets.show', [$ticket->id]) }}" title="View"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tickets.getStatus', [$ticket->id]) }}" title="Status"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-flag"></i>
                        </a>
                        <a href="{{ route('tickets.getMessage', [$ticket->id]) }}" title="Message"
                            class='btn btn-default btn-xs'>
                             <i class="far fa-comment"></i>
                         </a>
                    </div>
                    {!! Form::close() !!}
                    @endif
    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-left">
        {!! $tickets->appends(request()->input())->links() !!}
        
    </div>
</div>
