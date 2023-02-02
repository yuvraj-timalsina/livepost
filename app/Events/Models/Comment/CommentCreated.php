<?php

    namespace App\Events\Models\Comment;

    use App\Models\Comment;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class CommentCreated
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        protected Comment $comment;

        /**
         * Create a new event instance.
         *
         * @return void
         */
        public function __construct(Comment $comment)
        {
            $this->user = $comment;
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
