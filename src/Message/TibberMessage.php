<?php

namespace Arnebr\Tibber\Message;

use Arnebr\Tibber\Tibber;

class TibberMessage
{
    public ?string $title = null;

    public ?string $message = null;

    public ?string $screenToOpen = Tibber::APP_HOME;

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function screenToOpen(string $screenToOpen): self
    {
        $this->screenToOpen = $screenToOpen;

        return $this;
    }
}
