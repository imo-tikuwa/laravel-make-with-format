<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use ImoTikuwa\LaravelMakeWithFormat\LaravelMakeWithFormatServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'ImoTikuwa\\LaravelMakeWithFormat\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMakeWithFormatServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
