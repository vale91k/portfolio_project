<?php

namespace App\EventHandlers;

class ElementsIBlockEvents
{
    // Количество максимальных просмотров
    const  VIEWS_MAX_COUNT = 5;

    /**
     * ex2-50
     * При деактивации элемента ИБ Продукция выдает ошибку, если у него больше 5 просмотров
     * @param array $arFields
     * @return bool
     */
    public function checkOnDeactivationElement(array &$arFields): bool
    {
        global $APPLICATION;
        // Если меняем элемент каталога
        if ($arFields["IBLOCK_ID"] == IBLOCK_CATALOG_ID) {
            // Если элемент деактивирован
            if ($arFields["ACTIVE"] == "N") {
                $arSelect = [
                    "ID",
                    "IBLOCK_ID",
                    "NAME",
                    "SHOW_COUNTER"
                ];
                $arFilter = [
                    "IBLOCK_ID" => IBLOCK_CATALOG_ID,
                    "ID" => $arFields["ID"],
                ];
                $res = \CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
                $arItems = $res->fetch();
                // Если просмотров больше 5 (константа)
                if ($arItems["SHOW_COUNTER"] > self::VIEWS_MAX_COUNT) {
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