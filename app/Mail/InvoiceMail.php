<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $pdf)
    {
        $this->user = $user;
        $this->pdf = $pdf;
    }

    public function build(){
         return $this->subject('Monthly Invoice')
                ->with(['user' => $this->user])
                ->view('emails.invoice')
                 ->attachData($this->pdf, 'invoice.pdf', [
                    'mime' => 'application/pdf',
                ]);
    }
}
