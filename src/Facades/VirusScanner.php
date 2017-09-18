<?php

namespace Daniesy\VirusScanner\Facades;


use Illuminate\Support\Facades\Facade;

class VirusScanner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "VirusScanner";
    }
}