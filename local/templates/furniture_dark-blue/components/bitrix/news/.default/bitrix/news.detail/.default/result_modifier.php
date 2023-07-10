<?php
/**
 * Если имеется массив CANONICAL, достает ссылку с свойства и записывает в $arResult["CANONICAL_LINK"], полученное кешироуем (передаем в компонент эпилог)
 */

if (!empty($arParams["CANONICAL"])) {
    $arSelect = [
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_NEW"
    ];
    $arFilter = [
        "IBLOCK_ID" => $arParams["CANONICAL"],
        "PROPERTY_NEW" => $arResult["ID"],
        "ACTIVE" => "Y"
    ];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    if ($ob = $res->fetch()) {
        $arResult["CANONICAL_LINK"] = $ob["NAME"];
        $this->__component->SetResultCacheKeys(["CANONICAL_LINK"]);
    }
}