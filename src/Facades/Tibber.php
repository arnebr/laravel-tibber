<?php

namespace Arnebr\Tibber\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Arnebr\Tibber\Tibber
 */
class Tibber extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Arnebr\Tibber\Tibber::class;
    }
}
