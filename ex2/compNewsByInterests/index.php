<?php
use App\Helpers\BitrixHelper;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости по интересам");
?><?php
$APPLICATION->IncludeComponent(
    "exam2:compNewsByInterests",
    ".default",
    [
        "COMPONENT_TEMPLATE" => ".default",
        "NEWS_IBLOCK_ID" => BitrixHelper::getIdIBlockByCode("news_fur"),
        "PROPERTY_IBLOCK_CODE" => "AUTHOR",
        "USER_PROPERTY_CODE" => "UF_AUTHOR_TYPE",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y"
    ],
    false
); ?><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>