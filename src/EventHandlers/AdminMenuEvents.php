<?php

namespace App\EventHandlers;

class AdminMenuEvents
{
    /**
     * ex2-50
     * При деактивации элемента ИБ Продукция выдает ошибку, если у него больше 5 просмотров
     * @param array $arFields
     * @return bool
     */
    function checkOnDeactivationElement(array &$arFields): bool
    {
        // Если меняем элемент каталога
        if ($arFields["IBLOCK_ID"] == IBLOCK_CATALOG) {
            // Если элемент деактивирован
            if ($arFields["ACTIVE"] == "N") {
                $arSelect = [
                    "ID",
                    "IBLOCK_ID",
                    "NAME",
                    "SHOW_COUNTER"
                ];
                $arFilter = [
                    "IBLOCK_ID" => IBLOCK_CATALOG,
                    "ID" => $arFields["ID"],
                ];
                $res = \CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
                $arItems = $res->fetch();

                // Если просмотров больше 5 (константа)
                if ($arItems["SHOW_COUNTER"] > MAX_COUNT) {
                    global $APPLICATION;
                    $exText = GetMessage("CHECK_DEACTIVATED_ELEMENT_TEXT", ["#COUNT#" => $arItems["SHOW_COUNTER"]]);
                    $APPLICATION->throwException($exText);
                    return false;
                }
            }
        }
        return true;
    }
}