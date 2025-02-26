<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Event;
use ImoTikuwa\LaravelMakeWithFormat\Listeners\PostCommandCodeFormatter;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMakeWithFormatServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-make-with-format')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        if ($this->app->runningInConsole()) {
            Event::listen(CommandFinished::class, PostCommandCodeFormatter::class);
        }
    }
}
