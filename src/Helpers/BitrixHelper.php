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
            'ACTIVE' => 'Y',
            'CODE' => $code,
            'SITE_ID' => SITE_ID,
        ];
        $result = \CIBlock::GetList(false, $arrFilter, false);
        $iBlockId = $result->Fetch();
        if (isset ($iBlockId["ID"])) {
            return $iBlockId["ID"];
        }
        return '';

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
                'IBLOCK_ID' => $iBlockId,
                'CODE' => $code
            ]
        );
        $sectionId = $result->Fetch();
        if (isset ($sectionId['ID'])) {
            return $sectionId['ID'];
        }
        return '';
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
        if (!is_null($sectionId)) {
            $arFilter = [
                "IBLOCK_ID" => $iBlockId,
                "IBLOCK_SECTION_ID" => $sectionId,
                "CODE" => $code
            ];
        } else {
            $arFilter = [
                "IBLOCK_ID" => $iBlockId,
                "CODE" => $code
            ];
        }
        $result = \CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 1], ['ID']);
        $elementId = $result->Fetch();
        if (isset ($elementId['ID'])) {
            return $elementId['ID'];
        }
        return '';
    }


}