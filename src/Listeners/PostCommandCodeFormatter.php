<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Listeners;

use Illuminate\Console\Events\CommandFinished;

class PostCommandCodeFormatter
{
    public function handle(CommandFinished $event)
    {
        $event->output->writeln('test');
    }
}
