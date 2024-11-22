<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $subject, public $message, public $replyto, public $replytoname)
    {
        // $this->subject = $subject;
        // $this->message = $message;
        // $this->replyto = $replyto;
        // $this->replytoname = $replytoname;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS', config('MAIL_FROM_ADDRESS')), 'Dalma Project'),
            replyTo: [
                new Address($this->replyto, $this->replytoname),
            ],
            subject: $this->subject,
        );
    }



    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invitation',
            with: [
                'message' => $this->message,
                'subject' => $this->subject
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
