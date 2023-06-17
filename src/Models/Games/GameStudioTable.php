<?php

namespace App\Models\Games;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

/**
 * Class GameStudioTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME text optional
 * <li> UF_DESCRIPTION text optional
 * <li> UF_FOUNDED_AT date optional
 * </ul>
 *
 * @package Bitrix\Game
 **/
class GameStudioTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return 'app_game_studios';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            new IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => Loc::getMessage('STUDIOS_ENTITY_ID_FIELD')
                ]
            ),
            new TextField(
                'UF_NAME',
                [
                    'title' => Loc::getMessage('STUDIOS_ENTITY_UF_NAME_FIELD')
                ]
            ),
            new TextField(
                'UF_DESCRIPTION',
                [
                    'title' => Loc::getMessage('STUDIOS_ENTITY_UF_DESCRIPTION_FIELD')
                ]
            ),
            new DateField(
                'UF_FOUNDED_AT',
                [
                    'title' => Loc::getMessage('STUDIOS_ENTITY_UF_FOUNDED_AT_FIELD')
                ]
            ),
        ];
    }
}