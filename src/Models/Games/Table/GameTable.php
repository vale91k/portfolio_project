<?php

namespace App\Models\Games\Table;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

/**
 * Class Game
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME text optional
 * <li> UF_DESCRIPTION text optional
 * <li> UF_RELEASED_AT date optional
 * </ul>
 *
 * @package App\Models\Games
 **/
class GameTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return 'app_games';
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
                    'title' => 'ID'
                ]
            ),
            new TextField(
                'UF_NAME',
                [
                    'title' => 'Название'
                ]
            ),
            new TextField(
                'UF_DESCRIPTION',
                [
                    'title' => 'Описание'
                ]
            ),
            new DateField(
                'UF_RELEASED_AT',
                [
                    'title' => 'Дата релиза'
                ]
            ),
        ];
    }
}