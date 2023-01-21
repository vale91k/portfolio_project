<?php

namespace Sprint\Migration;


use App\Helpers\ModuleHelper;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use CUserTypeEntity;

class create_games_hlblock20230121192245 extends Version
{
    protected $description = "Создание нового HL блока Games";

    protected $moduleVersion = "4.2.4";

    private array $arLangs = [
        'ru' => 'Игры',
        'en' => 'Games'
    ];

    private array $fields = [
        'UF_NAME' => [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'MANDATORY' => 'Y',
            "EDIT_FORM_LABEL" => ['ru' => 'Название игры', 'en' => 'Name of the game'],
            "LIST_COLUMN_LABEL" => ['ru' => 'Название игры', 'en' => 'Name of the game'],
            "LIST_FILTER_LABEL" => ['ru' => 'Название игры', 'en' => 'Name of the game'],
            "ERROR_MESSAGE" => ['ru' => '', 'en' => ''],
            "HELP_MESSAGE" => ['ru' => '', 'en' => ''],
        ],
        'UF_DESCRIPTION' => [
            'FIELD_NAME' => 'UF_DESCRIPTION',
            'USER_TYPE_ID' => 'string',
            'MANDATORY' => 'Y',
            "EDIT_FORM_LABEL" => ['ru' => 'Описание', 'en' => 'Description'],
            "LIST_COLUMN_LABEL" => ['ru' => 'Описание', 'en' => 'Description'],
            "LIST_FILTER_LABEL" => ['ru' => 'Описание', 'en' => 'Description'],
            "ERROR_MESSAGE" => ['ru' => '', 'en' => ''],
            "HELP_MESSAGE" => ['ru' => '', 'en' => ''],
        ],
        'UF_RELEASED_AT' => [
            'FIELD_NAME' => 'UF_RELEASED_AT',
            'USER_TYPE_ID' => 'date',
            'MANDATORY' => 'Y',
            "EDIT_FORM_LABEL" => ['ru' => 'Дата релиза', 'en' => 'Game release date'],
            "LIST_COLUMN_LABEL" => ['ru' => 'Дата релиза', 'en' => 'Game release date'],
            "LIST_FILTER_LABEL" => ['ru' => 'Дата релиза', 'en' => 'Game release date'],
            "ERROR_MESSAGE" => ['ru' => '', 'en' => ''],
            "HELP_MESSAGE" => ['ru' => '', 'en' => ''],
        ],
    ];

    private string $hlBlockName = 'Games';

    /**
     * @throws LoaderException
     * @throws SystemException
     * @throws \Exception
     */
    public function up()
    {
        ModuleHelper::loadHLModule();

        in_transaction(function () {
            $result = HighloadBlockTable::add([
                'NAME' => $this->hlBlockName,
                'TABLE_NAME' => 'app_games',
            ]);


            if ($result->isSuccess()) {
                $id = $result->getId();
                foreach ($this->arLangs as $lang_key => $lang_val) {
                    HighloadBlockTable::add([
                        'ID' => $id,
                        'LID' => $lang_key,
                        'NAME' => $lang_val
                    ]);
                }
            } else {
                $errors = $result->getErrorMessages();
                throw new SystemException(implode(', ', $errors));
            }

            $entityId = 'HLBLOCK_' . $id;
            foreach ($this->fields as $field) {
                $field['ENTITY_ID'] = $entityId;
                $obUserField = new CUserTypeEntity;
                $obUserField->Add($field);
            }
        });
    }

    /**
     * @throws \Exception
     */
    public function down()
    {
        ModuleHelper::loadHLModule();

        in_transaction(function () {
            $hlblock = HighloadBlockTable::getList([
                'filter' => ['=NAME' => $this->hlBlockName]
            ])->fetch();
            if (!$hlblock) {
                throw new \Exception('Не найден HL Block с именем - ' . $this->hlBlockName);
            }
            $res = HighloadBlockTable::delete($hlblock['ID']);
            if (!$res->isSuccess()) {
                throw new \Exception('Ошибка при удалении HL Block с ИД - ' . $hlblock['ID']);
            }
        });
    }
}
