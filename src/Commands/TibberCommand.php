<?php

namespace Arnebr\Tibber\Commands;

use Illuminate\Console\Command;

class TibberCommand extends Command
{
    public $signature = 'laravel-tibber';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
