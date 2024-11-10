<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public Message $message) {}

    public function broadcastOn(): Channel
    {
        return new Channel('chatroom.'.$this->message->chatroom_id);
    }

    public function broadcastAs(): string
    {
        return 'chatroom.'.$this->message->chatroom_id;
    }
}
