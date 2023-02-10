<?php

namespace Arnebr\Tibber\Channels;

use Arnebr\Tibber\Facades\Tibber;
use Illuminate\Notifications\Notification;

class TibberChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        @phpstan-ignore-next-line
        $payload = $notification->toTibber($notifiable);
        Tibber::sendPushNotification($payload->title, $payload->message, $payload->screenToOpen);

        // Send notification to the $notifiable instance...
    }
}
