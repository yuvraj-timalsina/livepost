<?php

    namespace App\Notifications;

    use App\Models\Post;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class PostSharedNotification extends Notification
    {
        use Queueable;

        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public function __construct(Post $post, string $signedUrl)
        {
            $this->post = $post;
            $this->signedUrl = $signedUrl;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param mixed $notifiable
         *
         * @return array
         */
        public function via($notifiable)
        {
            // mail, database, broadcast, vonage, nexmo, slack, array
            return ['mail'];
        }

        /**
         * Get the mail representation of the notification.
         *
         * @param mixed $notifiable
         *
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {
            return (new MailMessage)
                ->subject('Post Shared: ' . $this->post->title)
                ->action('View Post", $this->signedUrl')
                ->line('Thank you for using Livepost!');
        }

        /**
         * Get the array representation of the notification.
         *
         * @param mixed $notifiable
         *
         * @return array
         */
        public function toArray($notifiable)
        {
            return [
                //
            ];
        }
    }
