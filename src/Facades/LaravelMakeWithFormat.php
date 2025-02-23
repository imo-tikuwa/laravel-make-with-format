<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ImoTikuwa\LaravelMakeWithFormat\LaravelMakeWithFormat
 */
class LaravelMakeWithFormat extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ImoTikuwa\LaravelMakeWithFormat\LaravelMakeWithFormat::class;
    }
}
