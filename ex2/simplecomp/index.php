<?php

use App\Helpers\BitrixHelper;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?>

<?php
$APPLICATION->IncludeComponent(
    "exam2:simplecomp.exam",
    ".default",
    [
        "PRODUCTS_IBLOCK_ID" => BitrixHelper::getIdIBlockByCode("furniture_products_s1"),
        "COMPONENT_TEMPLATE" => ".default",
        "NEWS_IBLOCK_ID" => BitrixHelper::getIdIBlockByCode("news_fur"),
        "PRODUCTS_IBLOCK_ID_PROPERTY" => "UF_NEWS_LINK",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ],
    false
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>