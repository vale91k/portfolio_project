<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
    return;
}

// Установка параметров, если они не заданы
if ($arParams["CACHE_TIME"]) {
    $arParams["CACHE_TIME"] = 36000000;
}

if ($arParams["PRODUCTS_IBLOCK_ID"]) {
    $arParams["PRODUCTS_IBLOCK_ID"] = 2;
}
if ($arParams["NEWS_IBLOCK_ID"]) {
    $arParams["NEWS_IBLOCK_ID"] = 1;
}

$arNavigation = CDBResult::GetNavParams($arNavParams);

// Кеширование (Проверка, если есть кеш вернется верстка)
if ($this->startResultCache(false, $arNavigation)) {

    $arNews = [];
    $arNewsID = [];

    //Получение новостей
    $obNews = CIBlockElement::GetList(
        [],
        [
            "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
            "ACTIVE" => "Y"
        ],
        false,
        [
            "nPageSize" => $arParams["ELEMENT_PER_PAGE"],
            "bShowAll" => true
        ],
        [
            "NAME",
            "ACTIVE_FROM",
            "ID"
        ]
    );
    $arResult["NAV_STRING"] = $obNews->GetPageNavString(GetMessage("SIMPLECOMP_EXAM2_PAGE_TITLE"));
    while ($newsElements = $obNews->Fetch()) {
        $arNewsID[] = $newsElements["ID"];
        $arNews[$newsElements["ID"]] = $newsElements;
    }

    // Получаем список активных разделов с привязкой к активным новостям
    $arSections = [];
    $arSectionsID = [];

    $obSection = CIBlockSection::GetList(
        [],
        [
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "ACTIVE",
            $arParams["PRODUCTS_IBLOCK_ID_PROPERTY"] => $arNewsID
        ],
        false,
        [
            "NAME",
            "IBLOCK_ID",
            "ID",
            $arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]
        ],
        false,

    );

    while ($arSectionCatalog = $obSection->Fetch()) {
        $arSectionsID[] = $arSectionCatalog["ID"];
        $arSections[$arSectionCatalog["ID"]] = $arSectionCatalog;
    }


    // Получим список активных товаров из разделов
    $obProducts = CIBlockElement::GetList(
        [],
        [
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "ACTIVE" => "Y",
            "SECTION_ID" => $arSectionsID
        ],
        false,
        false,
        [
            "NAME",
            "IBLOCK_SECTION_ID",
            "ID",
            "IBLOCK_ID",
            "PROPERTY_ARTNUMBER",
            "PROPERTY_MATERIAL",
            "PROPERTY_PRICE",
        ]
    );
    $arResult["PRODUCT_CNT"] = 0;
    while ($arProduct = $obProducts->Fetch()) {
        $arResult["PRODUCT_CNT"]++;
        foreach ($arSections[$arProduct["IBLOCK_SECTION_ID"]][$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newsId) {
            if (isset($arNews[$newsId])) {
                $arNews[$newsId]["PRODUCTS"][] = $arProduct;
            }
        }
    }

    // Распределение разделов по новостям
    foreach ($arSections as $arSection) {
        foreach ($arSection[$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newId) {
            if (isset($arNews[$newId])) {
                $arNews[$newId]['SECTIONS'][] = $arSection["NAME"];
            }
        }
    }
    $arResult["NEWS"] = $arNews;
    $this->SetResultCacheKeys(array("PRODUCT_CNT"));
    $this->includeComponentTemplate();
} else {
    $this->abortResultCache();
}
$APPLICATION->SetTitle(GetMessage("SIMPLECOMP_EXAM2_TITLE") .$arResult["PRODUCT_CNT"]);


?>