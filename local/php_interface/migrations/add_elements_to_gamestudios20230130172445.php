<?php

namespace Sprint\Migration;


use App\Helpers\ModuleHelper;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Exception;

class add_elements_to_gamestudios20230130172445 extends Version
{
    protected $description = "Добавление элемента к hl блоку GameStudios";

    protected $moduleVersion = "4.2.4";

    private string $hlBlockName = 'GameStudios';

    public function up()
    {
        ModuleHelper::loadHLModule();
        in_transaction(function () {
            $hlEntity = $this->getHlBlockEntityClass();

            $studios = [
                [
                    'UF_NAME' => 'Battlestate Games',
                    'UF_DESCRIPTION' => 'Battlestate Games Limited - Одна из российских независимых разработчиков и издателей, пока что только одной компьютерной игры. Основана в 2014 году, пост руководителя COO компании занимает Никита Буянов. Офис расположен в Санкт-Петербурге.',
                    'UF_FOUNDED_AT' => new Date('15.10.2014', 'd.m.Y'),
                ]
            ];

            foreach ($studios as $studio) {
                $res = $hlEntity::add($studio);
                if (!$res->isSuccess()) {
                    throw new Exception("Ошибка при добавлении студии в HL Block");
                }
            }
        });
    }

    public function down()
    {
        ModuleHelper::loadHLModule();
        in_transaction(function () {
            $hlEntity = $this->getHlBlockEntityClass();
            $elements = $hlEntity::getList([
                'select' => ['ID'],
                'filter' => ['=UF_NAME' => 'Battlestate Games']
            ])->fetchAll();
            foreach ($elements as $element) {
                $res = $hlEntity::delete($element['ID']);
                if (!$res->isSuccess()) {
                    throw new Exception("Ошибка при удалении элемента с ид - " . $element['ID']);
                }
            }
        });
    }

    private function getHlBlockEntityClass()
    {
        $hlblock = HighloadBlockTable::getList([
            'filter' => ['=NAME' => $this->hlBlockName]
        ])->fetch();
        if (!$hlblock) {
            throw new Exception('Не найден HL Block с именем - ' . $this->hlBlockName);
        }
        return getHLBlockEntityById((int)$hlblock['ID']);
    }
}
