<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Ticket;
use App\Models\Customer;
use App\Http\Requests\CreateTicketRequest;
use Illuminate\Support\Facades\Validator;
use App\Mail\TicketCreation;
use Illuminate\Support\Facades\Mail;

class CustomerController extends AppBaseController
{
    public function index(Request $request)
    {
        return view('customers.index');
    }

    public function status(Request $request)
    {
        return view('customers.status');
    }

    public function getStatus(Request $request)
    {
        //Get ticket status for customer
        if ($request->ticket_number != null) {
            $ticket = Ticket::with('user','customer','message')->where('ticket_number',$request->ticket_number)->first();
            if ($ticket) {
                return view('customers.view-status')->with('ticket',$ticket);
            }        
            Flash::Error('Ticket not found');
            return view('customers.status');
        }
        return view('customers.status');
        
    }

    public function create(CreateTicketRequest $request)
    {
        //Create ticket by customer
        try {
            //Validation
            $search = null;
            $name = null;
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //Check existing customer and create
            $customer = Customer::checkExistingCustomer($request);
            //Create ticket
            $ticket = Ticket::createTicket($customer,$request);
            //Send email to customer
            Mail::to($customer->email)->send(new TicketCreation($customer, $ticket));
            Flash::success('Ticket saved successfully.You REF NO : '.$ticket->ticket_number);
            return view('customers.index')
            ->with('ticket', $ticket)->with('search',$search)->with('name',$name);
        } catch (\Exception $e) {
            return back();
        }
        
    }
}
