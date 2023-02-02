<?php

    namespace App\Listeners;

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
            dd("Welcome email sent");
        }
    }
