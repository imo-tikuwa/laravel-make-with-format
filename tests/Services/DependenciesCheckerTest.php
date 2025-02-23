<?php

declare(strict_types=1);

use ImoTikuwa\LaravelMakeWithFormat\Services\DependenciesChecker;
use Illuminate\Support\Facades\App;

beforeEach(function () {
    $this->checker = new DependenciesChecker();
});

it('returns true when Pint is executable', function () {
    $checker = Mockery::mock(DependenciesChecker::class)->makePartial();
    $checker->shouldAllowMockingProtectedMethods();
    $checker->shouldReceive('runShellCommand')
        ->with("which ./vendor/bin/pint")
        ->andReturn('/some/path/to/pint');

    /** @var DependenciesChecker $checker */
    expect($checker->isPintExecutable())->toBeTrue();
});

it('returns false when Pint is not executable', function () {
    $checker = Mockery::mock(DependenciesChecker::class)->makePartial();
    $checker->shouldAllowMockingProtectedMethods();
    $checker->shouldReceive('runShellCommand')
        ->with("which ./vendor/bin/pint")
        ->andReturn('');

    /** @var DependenciesChecker $checker */
    expect($checker->isPintExecutable())->toBeFalse();
});

it('returns true when IdeHelper is executable', function () {
    // プログラム内の class_exists を通すためのモック
    Mockery::mock(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

    App::shouldReceive('providerIsLoaded')
        ->with(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class)
        ->andReturn(true);

    $checker = Mockery::mock(DependenciesChecker::class)->makePartial();
    $checker->shouldAllowMockingProtectedMethods();
    $checker->shouldReceive('runShellCommand')
        ->with("which ./artisan")
        ->andReturn('/some/path/to/artisan');

    /** @var DependenciesChecker $checker */
    expect($checker->isIdeHelperExecutable())->toBeTrue();
});

it('returns false when IdeHelper is not executable due to missing provider', function () {
    App::shouldReceive('providerIsLoaded')
        ->with(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class)
        ->andReturn(false);

    expect($this->checker->isIdeHelperExecutable())->toBeFalse();
});

it('returns false when IdeHelper is not executable due to missing artisan', function () {
    App::shouldReceive('providerIsLoaded')
        ->with(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class)
        ->andReturn(true);

    $checker = Mockery::mock(DependenciesChecker::class)->makePartial();
    $checker->shouldAllowMockingProtectedMethods();
    $checker->shouldReceive('runShellCommand')
        ->with("which ./artisan")
        ->andReturn('');

    /** @var DependenciesChecker $checker */
    expect($checker->isIdeHelperExecutable())->toBeFalse();
});
