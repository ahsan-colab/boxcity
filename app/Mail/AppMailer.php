<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppMailer extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectLine;
    public string $viewName;
    public $viewData;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectLine, string $viewName, array $viewData = [])
    {
        $this->subjectLine = $subjectLine;
        $this->viewName = $viewName;
        $this->viewData = $viewData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->viewName,
            with: $this->viewData
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
