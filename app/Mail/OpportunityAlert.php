<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OpportunityAlert extends Mailable implements ShouldQueue
{
    use SerializesModels;
    use Queueable;

    public $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        logger('constructing message');
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        logger('envelope');
        return new Envelope(
            subject: 'Opportunity Alert!!!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        logger('I am in content');
        return new Content(
            markdown: 'mail.newOpportunity',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        logger('I attachment');
        return [];
    }
}
