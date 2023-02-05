<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class VerifyMail extends Mailable
    {
        use Queueable, SerializesModels;

        public $user, $url;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($user, $url)
        {
            $this->user = $user;
            $this->url = $url;
        }

        /**
         * Get the message envelope.
         *
         * @return \Illuminate\Mail\Mailables\Envelope
         */
        public function envelope()
        {
            return new Envelope(
                to : $this->user->email,
                subject : 'Verify Mail',
            );
        }

        /**
         * Get the message content definition.
         *
         * @return \Illuminate\Mail\Mailables\Content
         */
        public function content()
        {
            return new Content(
                markdown : 'mail.verify',
            );
        }

        /**
         * Get the attachments for the message.
         *
         * @return array
         */
        public function attachments()
        {
            return [];
        }
    }
