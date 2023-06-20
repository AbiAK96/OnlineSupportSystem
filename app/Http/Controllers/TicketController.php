<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Customer;
use App\Models\TicketItems;
use App\Mail\TicketAssign;
use Illuminate\Support\Facades\Mail;

class TicketController extends AppBaseController
{
    public function index(Request $request)
    {
        //Get All tickets for loged user
        $tickets = Ticket::getTicketByRole(auth()->user()->role_id);   
        $name = null;
        $search = null;
        return view('tickets.index')
            ->with('tickets', $tickets)->with('name', $name)->with('search',$search);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create($request);

        Flash::success('Ticket saved successfully.');

        return redirect(route('tickets.index'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user','customer')->find($id);
        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.show')->with('ticket', $ticket);
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $followed_by = User::where('role_id','!=',1)->pluck('first_name','id');
        $followed_id = null;

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.edit')->with('ticket', $ticket)
        ->with('followed_by', $followed_by)
        ->with('followed_id', $followed_id);
    }

    public function getStatus($id)
    {
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }
        //Status Const
        $status = Ticket::STATUS;
        $status_id = null;
        return view('tickets.status-edit')->with('ticket', $ticket)->with('status', $status)->with('status_id', $status_id);
    }

    public function updateStatus($id,Request $request)
    {
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $ticket->status = $request->status;
        $ticket->update();

        Flash::success('Ticket updated successfully.');

        return redirect(route('tickets.index'));
    }

    public function getMessage($id)
    {
        $ticket = Ticket::with('message')->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }
        return view('tickets.message-add')->with('ticket', $ticket);
    }

    public function storeMessage(Request $request)
    {
       $ticketItems = TicketItems::saveMessage($request);
       Flash::success('Messag eadded successfully.');

       return redirect(route('tickets.index'));
    }

    public function update($id,Request $request)
    {
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }
        //Admin assign ticket to user
        $ticket->followed_by = $request->followed_by;
        $ticket->status = 'Pending';
        $ticket->update();
        $customer = Customer::find($ticket->customer_id);
        $user = User::find($ticket->followed_by);
        Mail::to($customer->email)->send(new TicketAssign($customer, $ticket,$user));

        Flash::success('Ticket updated successfully.');

        return redirect(route('tickets.index'));
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $ticket->delete();

        Flash::success('Ticket deleted successfully.');

        return redirect(route('tickets.index'));
    }

    public function search(Request $request)
    {   
        $search = $request->all();
    
        $query = Customer::with('user', 'customer')
									->join('tickets', 'tickets.customer_id', '=', 'customers.id')
									->select('tickets.*')
									->OrderBy('id', 'desc');
        if ($request->name != null)
            {
				$query = $query->where('customers.name', 'LIKE', "%{$request->name}%");            
            }
        
            //Paginate
        $tickets = $query->paginate(10);
        $name = $request->name;
        $search = null;
        return view('tickets.index')
        ->with('tickets', $tickets)->with('name', $name)->with('search',$search);
    }
}
