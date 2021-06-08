<?php

namespace Temify\RepositoryPattern\Facades;

use Illuminate\Support\Facades\Facade;

class RepositoryPattern extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RepositoryPattern';
    }

}
