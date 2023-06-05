<?php

namespace Sprint\Migration;


use App\Helpers\ModuleHelper;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use CUserTypeEntity;

class create_gamestudios_hlblock20230123150816 extends Version
{
    protected $description = "Создание HL блока GameStudios";

    protected $moduleVersion = "4.2.4";

    private array $arLangs = [
        'ru' => 'Игровые студии',
        'en' => 'Game Studios'
    ];

    private array $fields = [
        'UF_NAME' => [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'MANDATORY' => 'Y',
            "EDIT_FORM_LABEL" => ['ru' => 'Название компании', 'en' => 'Name of the studio'],
            "LIST_COLUMN_LABEL" => ['ru' => 'Название компании', 'en' => 'Name of the studio'],
            "LIST_FILTER_LABEL" => ['ru' => 'Название компании', 'en' => 'Name of the studio'],
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
        'UF_FOUNDED_AT' => [
            'FIELD_NAME' => 'UF_FOUNDED_AT',
            'USER_TYPE_ID' => 'date',
            'MANDATORY' => 'Y',
            "EDIT_FORM_LABEL" => ['ru' => 'Дата основания', 'en' => 'Studio founded date'],
            "LIST_COLUMN_LABEL" => ['ru' => 'Дата основания', 'en' => 'Studio founded date'],
            "LIST_FILTER_LABEL" => ['ru' => 'Дата основания', 'en' => 'Studio founded date'],
            "ERROR_MESSAGE" => ['ru' => '', 'en' => ''],
            "HELP_MESSAGE" => ['ru' => '', 'en' => ''],
        ],
    ];

    private string $hlBlockName = 'GameStudios';

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
                'TABLE_NAME' => 'app_game_studios',
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
