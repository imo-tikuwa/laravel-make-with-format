<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Services\CommandRunner;

use Illuminate\Console\Events\CommandFinished;

interface RunnerInterface
{
    public function run(string $target, CommandFinished $event): void;
}
