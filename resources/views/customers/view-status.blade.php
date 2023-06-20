<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Login</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"
          integrity="sha512-mxrUXSjrxl8vm5GwafxcqTrEwO1/oBNU25l20GODsysHReZo4uhVISzAKzaABH6/tTfAxZrY2FprmeAP5UZY8A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  @include('adminlte-templates::common.errors')
  @include('flash::message')
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('img/edu.png') }}"  
            class="pb-2" alt="Logo" width="50px">    
        </a>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="col-sm-12">
      {!! Form::label('name', 'Customer Name:') !!}
      <p>{{ $ticket->customer->name }}</p>
    </div>

    <div class="col-sm-12">
      {!! Form::label('description', 'Description:') !!}
      <p>{{ $ticket->description }}</p>
    </div>

    <div class="col-sm-12">
      {!! Form::label('ticket_number', 'Ticket number:') !!}
      <p>{{ $ticket->ticket_number }}</p>
    </div>

    <div class="col-sm-12">
      {!! Form::label('status', 'Status:') !!}
      <p>{{ $ticket->status }}</p>
    </div>
    <div class="col-sm-12">
      @if ($ticket->followed_by == null)
      {!! Form::label('followed_by', 'Followed by:') !!}
      <p>Not assinged yet </p>
    </div>
      @else
      <div class="col-sm-12">
        {!! Form::label('followed_by', 'Followed by:') !!}
        <p>{{ $ticket->user->first_name }}</p>
      </div>
      @endif

      <div class="col-sm-12">
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
  <script>
    // Fetch the CSRF token value
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Add the CSRF token to the form data or request headers
    // Example using AJAX with jQuery
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    });
  </script>
  <style>
    /* Style inputs with type="text", select elements and textareas */
input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
  </style>
  </div>
</div>
</div>
  </body>
  </html>
