<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use App\Models\Order;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public Collection $order;
    public $codeOrder;

    /**
     * Create a new message instance.
     */
    public function __construct(Collection $order, $codeOrder)
    {
        //
        $this->order = $order;
        $this->codeOrder = $codeOrder;
    }

    public function build()
    {
        return $this
            ->subject('Pedido confirmado - Footsyde')
            ->view('emails.order-confirmed');
    }
}
