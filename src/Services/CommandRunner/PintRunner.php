<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Services\CommandRunner;

use Illuminate\Console\Events\CommandFinished;
use ImoTikuwa\LaravelMakeWithFormat\Services\DependenciesChecker;
use ImoTikuwa\LaravelMakeWithFormat\Services\CommandProcessService;

class PintRunner implements RunnerInterface
{
    public function __construct(
        private readonly CommandProcessService $commandProcessService,
        private readonly DependenciesChecker $dependenciesChecker,
    ) {}

    public function run(string $target, CommandFinished $event): void
    {
        if (!$this->dependenciesChecker->isPintExecutable()) {
            return;
        }

        $event->output->writeln('');
        $event->output->writeln("<info>Running pint on {$target}</info>");

        $this->commandProcessService->runProcess([
            './vendor/bin/pint',
            $target,
        ], $event);

        if ($event->input->hasOption('test') || $event->input->hasOption('pest')) {
            $target = str_replace('app/', 'tests/Feature/', $target);

            $event->output->writeln('');
            $event->output->writeln("<info>Running pint on {$target}</info>");

            $this->commandProcessService->runProcess([
                './vendor/bin/pint',
                $target,
            ], $event);
        }
    }
}
