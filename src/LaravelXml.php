<?php

namespace Bmatovu\LaravelXml;

use Illuminate\Support\Facades\Facade;

class LaravelXml extends Facade
{
    /**
     * Get the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-xml';
    }
}
