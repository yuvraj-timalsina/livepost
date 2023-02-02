<?php

    namespace App\Events\Models\Post;

    use App\Models\Post;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class PostUpdated
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        protected Post $post;

        /**
         * Create a new event instance.
         *
         * @return void
         */
        public function __construct(Post $post)
        {
            $this->user = $post;
        }

        /**
         * Get the channels the event should broadcast on.
         *
         * @return \Illuminate\Broadcasting\Channel|array
         */
        public function broadcastOn()
        {
            return new PrivateChannel('channel-name');
        }
    }
