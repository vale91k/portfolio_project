<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
    return;
}

if ($this->startResultCache(false, [$USER->GetGroups()])) {
    $arClassif = [];
    $arClassifId = [];
    $arResult["COUNT"] = 0;
    // Список активных элементов
    $arSelectElems = [
        "ID",
        "IBLOCK_ID",
        "NAME",

    ];
    $arFilterElems = [
        "IBLOCK_ID" => $arParams["CLASSIFIER_IBLOCK_ID"],
        "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
        "ACTIVE" => "Y"
    ];
    $rsElements = CIBlockElement::GetList([], $arFilterElems, false, false, $arSelectElems);
    while ($arElement = $rsElements->Fetch()) {
        $arClassif[$arElement["ID"]] = $arElement;
        $arClassifId[] = $arElement["ID"];
    }
    $arResult["COUNT"] = count($arClassifId);

    // Получаем тех, у кого есть привязка
    $arSelectElementsCatalog = [
        "ID",
        "IBLOCK_ID",
        "IBLOCK_SECTION_ID",
        "NAME",
        "DETAIL_PAGE_URL"
    ];
    $arFilterElementsCatalog = [
        "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
        "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
        "PROPERTY_*" . $arParams["PROPERTY_CODE"] => $arClassifId,
        "ACTIVE" => "Y"
    ];
    $rsElements = CIBlockElement::GetList([], $arFilterElementsCatalog, false, false, $arSelectElementsCatalog);

    while($rsEl = $rsElements->GetNextElement()) {
        // Получает инфу с элементов, имеющих привязку
        $arField = $rsEl->GetFields();
        $arField["PROPERTY"] = $rsEl->GetProperties();

        foreach ($arField["PROPERTY"]["FIRM"]["VALUE"] as $value) {
            $arClassif[$value]["ELEMENTS"][$arField["ID"]] = $arField;
        }
//        $arResult["ELEMENTS"][$arField["ID"]] = $arField;
    }
    $arResult["CLASSIFIER"] = $arClassif;
    $this->SetResultCacheKeys(["COUNT"]);
    $this->includeComponentTemplate();
} else {
    $this->abortResultCache();
}
$APPLICATION->SetTitle(GetMessage("CLASSCOMP_COUNT") . $arResult["COUNT"]);
