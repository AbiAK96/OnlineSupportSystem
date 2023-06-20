<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketAssign extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $ticket;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer,$ticket,$user)
    {
        $this->customer = $customer;
        $this->ticket = $ticket;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.ticketAssign')->subject('Your ticket in progress')->with([
            'customer' => $this->customer,
            'ticket' => $this->ticket,
            'user' => $this->user
        ]);
    }
}
