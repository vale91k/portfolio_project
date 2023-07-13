<?php

use App\Helpers\BitrixHelper;

// Определяем id Инфоблока Продукция
define('ID_IBLOCK_CATALOG', BitrixHelper::getIdIBlockByCode('furniture_products_s1'));

//Определяем id Инфоблока Метатеги
define('IBLOCK_META', BitrixHelper::getIdIBlockByCode("global_meta"));