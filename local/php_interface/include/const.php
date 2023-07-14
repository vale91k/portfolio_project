<?php

use App\Helpers\BitrixHelper;

// Определяем id Инфоблока Продукция
define('IBLOCK_CATALOG_ID', BitrixHelper::getIdIBlockByCode('furniture_products_s1'));

//Определяем id Инфоблока Метатеги
define('IBLOCK_META_TAGS_ID', BitrixHelper::getIdIBlockByCode("global_meta"));