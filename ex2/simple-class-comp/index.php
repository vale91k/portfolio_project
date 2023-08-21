<?php
use App\Helpers\BitrixHelper;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог по классификатору");
?><?php
$APPLICATION->IncludeComponent(
    "exam2:simplecomp.exam.71",
    ".default",
    [
        "COMPONENT_TEMPLATE" => ".default",
        "PRODUCTS_IBLOCK_ID" => BitrixHelper::getIdIBlockByCode("furniture_products_s1"),
        "CLASSIFIER_IBLOCK_ID" => BitrixHelper::getIdIBlockByCode("furniture_firms_s1"),
        "TEMPLATE_DETAIL" => "",
        "PROPERTY_CODE" => "FIRM",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y"
    ],
    false
); ?><?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>