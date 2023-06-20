<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreation extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer,$ticket)
    {
        $this->customer = $customer;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.ticketCreation')->subject('New ticket has been created')->with([
            'customer' => $this->customer,
            'ticket' => $this->ticket
        ]);
    }
}
