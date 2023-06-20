@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tickets</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">

          {!! Form::open(['route' => 'tickets.message.store']) !!}

          <div class="card-body">

              <div class="row">
                <div class="form-group col-sm-6">
                  {!! Form::label('message', 'Message:') !!}
                  {!! Form::text('message', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
              </div>
              <input type="text" id="ticket_id" name="ticket_id" placeholder="Customer Name.." value="{{ $ticket->id}}" hidden>
              </div>

          </div>

          <div class="card-footer">
              {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
              <a href="{{ route('tickets.index') }}" class="btn btn-default">Cancel</a>
          </div>

          {!! Form::close() !!}

      </div>
        <div class="card">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-bordered" id="tickets-table">
                    <thead>
                    <tr>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ticket->message as $message)
                        <tr>
                            <td>{{ $message->message }}</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>

        </div>
    </div>

@endsection

