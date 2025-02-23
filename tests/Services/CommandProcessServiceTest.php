<?php

declare(strict_types=1);

use ImoTikuwa\LaravelMakeWithFormat\Services\CommandProcessService;
use Illuminate\Console\Events\CommandFinished;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

it('runs process and handles output correctly', function () {
    $commands = ['echo', 'Hello, World!'];

    // Mock OutputInterface
    $output = Mockery::mock(OutputInterface::class);
    $output->shouldReceive('write')->once()->with("Hello, World!\n"); // stdout の処理を確認
    $output->shouldReceive('writeln')->never(); // stderr の処理は呼ばれないはず

    // Mock CommandFinished event
    /** @var CommandFinished $event */
    $event = Mockery::mock(CommandFinished::class);
    $event->output = $output;

    // Mock Process
    $process = Mockery::mock(Process::class);
    $process->shouldReceive('run')
        ->once()
        ->with(Mockery::on(function ($callback) use ($output) {
            $callback(Process::OUT, "Hello, World!\n"); // stdout
            return true;
        }));

    // CommandProcessService のモックを作り、createProcess() の挙動を差し替え
    $service = Mockery::mock(CommandProcessService::class)->makePartial();
    $service->shouldAllowMockingProtectedMethods();
    $service->shouldReceive('createProcess')->once()->with($commands)->andReturn($process);

    // 実行
    /** @var CommandProcessService $service */
    $service->runProcess($commands, $event);
});
