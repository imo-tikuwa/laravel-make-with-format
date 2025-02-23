<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Services;

use Illuminate\Support\Facades\App;

class DependenciesChecker
{
    /**
     * Pintが実行可能か判定
     */
    public function isPintExecutable(): bool
    {
        return $this->isCliAvailable('./vendor/bin/pint');
    }

    /**
     * IdeHelperが実行可能か判定
     */
    public function isIdeHelperExecutable(): bool
    {
        return class_exists(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class) && App::providerIsLoaded(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class) && $this->isCliAvailable('./artisan');
    }

    /**
     * CLIコマンドが利用可能かチェック
     */
    private function isCliAvailable(string $cliPath): bool
    {
        $command = $this->isWindows() ? "where {$cliPath}" : "which {$cliPath}";

        return !empty($this->runShellCommand($command));
    }

    /**
     * OSがWindowsかどうかを判定
     */
    protected function isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    /**
     * shell_exec をラップ
     */
    protected function runShellCommand(string $command): ?string
    {
        return shell_exec($command);
    }
}
