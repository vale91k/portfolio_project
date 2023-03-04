<?php

use App\Services\DataService;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
    die();


class DataServiceComponent extends \CBitrixComponent
{

    public function executeComponent()
    {
        $this->arResult['DATA_SERVICE'] = new DataService();
        $this->includeComponentTemplate();
    }
}