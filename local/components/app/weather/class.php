<?php

use App\Services\WeatherService;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
    die();


class WeatherComponent extends \CBitrixComponent
{

    public function executeComponent()
    {
        $this->arResult['WEATHER_SERVICE'] = new WeatherService();
        $this->includeComponentTemplate();
    }
}