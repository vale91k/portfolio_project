<?php

namespace App\EventHandlers;

class MetaChangerEventHandler
{
    /**
     * ex2-94
     * Использование title и description из ИБ Метатеги (по посещению страниц Продукции)
     * @throws \Bitrix\Main\LoaderException
     */
    function toolSEOSpecialist(): void
    {
        global $APPLICATION;
        $curPage = $APPLICATION->GetCurDir();
        //Проверка на подключение модуля работы с инфоблоками
        if (\Bitrix\Main\Loader::includeModule("iblock")) {

            $arFilter = [
                "IBLOCK_ID" => IBLOCK_META,
                "NAME" => $curPage
            ];

            $arSelect = [
                "IBLOCK_ID",
                "ID",
                "PROPERTY_mega_title",
                "PROPERTY_mega_description"
            ];

            $ob = \CIBlockElement::GetList(
                [],
                $arFilter,
                false,
                false,
                $arSelect
            );

            if ($arRes = $ob->Fetch()) {

                $APPLICATION->SetPageProperty('title', $arRes["PROPERTY_MEGA_TITLE_VALUE"]);
                $APPLICATION->SetPageProperty('description', $arRes["PROPERTY_MEGA_DESCRIPTION_VALUE"]);
            }
        }
    }
}