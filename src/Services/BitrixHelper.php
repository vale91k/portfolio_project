<?php

namespace app\Services;

use Bitrix\Main\Localization;
\CModule::IncludeModule("iblock");
Localization\Loc::loadMessages(__FILE__);



class BitrixHelper
{
    /**
     * Возвращает Id инфоблока
     * @param $code
     * @return string
     */
    static function getIdIBlockByCode($code): string
    {
        $arrFilter = [
            'ACTIVE' => 'Y',
            'CODE' => $code,
            'SITE_ID' => "s1",
        ];
        $result = \CIBlock::GetList(["SORT" => "ASC"], $arrFilter, false);
        $iBlockId = $result->Fetch();
        return $iBlockId["ID"];
    }

    /**
     * Возвращает id раздела
     * @param $code
     * @param $iBlockId
     * @return string
     */
    static function getIdSectionByCode($code, $iBlockId): string
    {
        $result = \CIBlockSection::GetList([],
            [
                'IBLOCK_ID' => $iBlockId,
                'CODE' => $code
            ]
        );
        $sectionId = $result->Fetch();
        return $sectionId['ID'];
    }

    /**
     * Возвращает id элемента
     * @param $code
     * @param $iBlockId
     * @param $sectionId
     * @return string
     */
    static function getIdElementByCode($code, $iBlockId, $sectionId): string
    {
        $arFilter = [
            "IBLOCK_ID" => $iBlockId,
            "IBLOCK_SECTION_ID" => $sectionId,
            "CODE" => $code
        ];
        $result = \CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 1], ['ID']);
        $elementId = $result->Fetch();
        return $elementId['ID'];
    }


}