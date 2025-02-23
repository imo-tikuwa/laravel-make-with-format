<?php

namespace ImoTikuwa\LaravelMakeWithFormat\Commands;

use Illuminate\Console\Command;

class LaravelMakeWithFormatCommand extends Command
{
    public $signature = 'laravel-make-with-format';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
