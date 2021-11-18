<?php

namespace App\HelperFacade;


use Illuminate\Support\Facades\Facade;
use App\Helper\HelperMigrate;

class HelperMigrateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HelperMigrate::class;
    }
}