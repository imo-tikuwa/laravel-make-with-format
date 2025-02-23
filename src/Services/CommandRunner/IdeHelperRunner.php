<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Services\CommandRunner;

use Illuminate\Console\Events\CommandFinished;
use ImoTikuwa\LaravelMakeWithFormat\Services\DependenciesChecker;
use ImoTikuwa\LaravelMakeWithFormat\Services\CommandProcessService;

class IdeHelperRunner implements RunnerInterface
{
    public function __construct(
        private readonly CommandProcessService $commandProcessService,
        private readonly DependenciesChecker $dependenciesChecker
    ) {}

    public function run(string $target, CommandFinished $event): void
    {
        if (!$this->dependenciesChecker->isIdeHelperExecutable()) {
            return;
        }

        $event->output->writeln('');
        $event->output->writeln("<info>Running ide-helper:models on {$target}</info>");

        $this->commandProcessService->runProcess([
            './artisan',
            'ide-helper:models',
            '--write',
            '--reset',
            '--no-interaction',
            '--dir',
            $target,
        ], $event);
    }
}
