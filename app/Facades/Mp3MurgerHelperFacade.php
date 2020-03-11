<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class Mp3MurgerHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mp3Helper';
    }
}