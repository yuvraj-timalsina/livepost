<?php

    namespace App\Events;

    use App\Models\User;
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;

    class ChatMessageEvent implements ShouldBroadcast
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        private string $message;
        private User $user;

        /**
         * Create a new event instance.
         *
         * @return void
         */
        public function __construct(string $message, User $user)
        {
            $this->message = $message;
            $this->user = $user;
        }

        /**
         * Get the channels the event should broadcast on.
         *
         * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\PresenceChannel|array
         */
        public function broadcastOn() : Channel | PresenceChannel | array
        {
            return new PresenceChannel('presence.chat.1');
        }

        public function broadcastAs() : string
        {
            return 'chat-message';
        }

        public function broadcastWith() : array
        {
            return [
                'message' => $this->message,
                'user' => $this->user->only(['name', 'email'])
            ];
        }
    }
