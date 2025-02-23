<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Services;

use Illuminate\Console\Events\CommandFinished;
use Symfony\Component\Process\Process;

class CommandProcessService
{
    public function runProcess(array $commands, CommandFinished $event): void
    {
        /** @var \Symfony\Component\Console\Output\OutputInterface $output */
        $output = $event->output; // PostCommandCodeFormatter リスナー側で null の場合に早期リターンしてるのでここでnullにはなり得ない（はず）
        $process = $this->createProcess($commands);

        $process->run(function ($type, $buffer) use ($output) {
            if ($type === Process::ERR) {
                $output->writeln("<error>{$buffer}</error>");
            } else {
                $output->write($buffer);
            }
        });
    }

    protected function createProcess(array $commands): Process
    {
        return new Process($commands);
    }
}
