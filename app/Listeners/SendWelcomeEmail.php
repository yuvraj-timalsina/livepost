<?php

    namespace App\Listeners;

    use App\Mail\WelcomeMail;
    use Illuminate\Support\Facades\Mail;

    class SendWelcomeEmail
    {
        /**
         * Create the event listener.
         *
         * @return void
         */
        public function __construct()
        {
            //
        }

        /**
         * Handle the event.
         *
         * @param object $event
         *
         * @return void
         */
        public function handle($event)
        {
            Mail::to($event->user)->send(new WelcomeMail($event->user));
        }
    }
