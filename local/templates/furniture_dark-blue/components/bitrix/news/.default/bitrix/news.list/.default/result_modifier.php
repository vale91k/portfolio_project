<?php
/**
 * Если активен параметр SPECIALDATE получаем первый элемент по дате ACTIVE_FROM
 */

if ($arParams["SPECIALDATE"] == "Y") {
    $arResult["DATE_FIRST_NEWS"] = $arResult["ITEMS"][0]["ACTIVE_FROM"];
    /**
     * Чтобы передавать данные в компонент эпилог его нужно кешировать
     */
    $this->__component->SetResultCacheKeys(["DATE_FIRST_NEWS"]);
}