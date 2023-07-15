<?php

namespace App\EventHandlers;

class MetaChangerEventHandler
{
    /**
     * ex2-94
     * С помощью свойств элемента ИБ Метатеги (title и description) дает возможность
     * изменять tittle и description на страницах раздела "Продукция".
     * @throws \Bitrix\Main\LoaderException
     */
    public function productsTittleDescriptionChanger(): void
    {
        global $APPLICATION;
        $curPage = $APPLICATION->GetCurDir();
        //Проверка на подключение модуля работы с инфоблоками
        if (\Bitrix\Main\Loader::includeModule('iblock')) {

            $arFilter = [
                "IBLOCK_ID" => IBLOCK_META_TAGS_ID,
                "NAME" => $curPage
            ];

            $arSelect = [
                "IBLOCK_ID",
                "ID",
                "PROPERTY_mega_title",
                "PROPERTY_mega_description"
            ];

            $res = \CIBlockElement::GetList(
                [],
                $arFilter,
                false,
                false,
                $arSelect
            );

            if ($arRes = $res->Fetch()) {

                $APPLICATION->SetPageProperty('title', $arRes["PROPERTY_MEGA_TITLE_VALUE"]);
                $APPLICATION->SetPageProperty('description', $arRes["PROPERTY_MEGA_DESCRIPTION_VALUE"]);
            }
        }
    }
}