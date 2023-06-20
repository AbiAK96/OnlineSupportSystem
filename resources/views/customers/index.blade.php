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

</head>
<body class="hold-transition login-page">
<div class="login-box">
  @include('adminlte-templates::common.errors')
  
  <div class="card">
    
    <div class="card-body login-card-body">
      @include('flash::message')
      <div class="login-logo">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('img/edu.png') }}"  
            class="pb-2" alt="Logo" width="50px">    
        </a>
    </div>  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form method="POST" action="{!! route('customer.ticket') !!}">
        @csrf
      <label for="fname">Customer Name</label>
      <input type="text" id="name" name="name" placeholder="Customer Name.." value="{{ old('name') }}">
  
      <label for="lname">Email</label>
      <input type="text" id="email" name="email" placeholder="Email.." value="{{ old('email') }}">
  
      <label for="lname">Mobile Number</label>
      <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number.." value="{{ old('mobile_number') }}">
  
      <label for="subject">Description</label>
      <textarea id="description" name="description" placeholder="Write something.." style="height:200px" value="{{ old('description') }}"></textarea>
  
      <input type="submit" value="Submit">
  
    </form>
    <div class="card-footer">
      <div class="col-sm-6">
        <a class="btn btn-primary float-left"
           href="{!! route('ticket.status') !!}">
               Track   
        </a>
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
