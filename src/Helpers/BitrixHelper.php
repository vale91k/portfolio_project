<?php

namespace App\Helpers;

use Bitrix\Main\Localization;

\CModule::IncludeModule("iblock");
Localization\Loc::loadMessages(__FILE__);


class BitrixHelper
{
    /**
     * Возвращает Id инфоблока
     * @param string $code
     * @return string
     */
    static function getIdIBlockByCode(string $code): string
    {
        $arrFilter = [
            '=ACTIVE' => 'Y',
            '=CODE' => $code,
            '=SITE_ID' => SITE_ID,
        ];
        $result = \CIBlock::GetList(false, $arrFilter, false);
        $iBlockItem = $result->Fetch();
        return $iBlockItem['ID'] ?? '';
    }

    /**
     * Возвращает id раздела
     * @param string $code
     * @param string $iBlockId
     * @return string
     */
    static function getIdSectionByCode(string $code, string $iBlockId): string
    {
        $result = \CIBlockSection::GetList([],
            [
                '=IBLOCK_ID' => $iBlockId,
                '=CODE' => $code
            ]
        );
        $sectionItem = $result->Fetch();
        return $sectionItem['ID'] ?? '';
    }

    /**
     * Возвращает id элемента
     * @param string $code
     * @param string $iBlockId
     * @param string|null $sectionId
     * @return string
     */
    static function getIdElementByCode(string $code, string $iBlockId, string $sectionId = null): string
    {
        $arFilter = [
            "=IBLOCK_ID" => $iBlockId,
            "=CODE" => $code
        ];
        if ($sectionId) {
            $arFilter['=IBLOCK_SECTION_ID'] = $sectionId;
        }
        $result = \CIBlockElement::GetList([], $arFilter, false, false, ['ID']);
        $elementIBlockItem = $result->Fetch();
        return $elementIBlockItem['ID'] ?? '';
    }


}