<?php

namespace Lodeb\SEO\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lodeb\SEO\SEO
 */
class SEO extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Lodeb\SEO\SEO::class;
    }
}
