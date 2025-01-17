<?php

declare(strict_types=1);

namespace Camroncade\Timezone\Facades;

use Illuminate\Support\Facades\Facade;

class Timezone extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'timezone';
    }
}
