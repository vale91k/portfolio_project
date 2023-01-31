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

class add_elements_to_gamestudios20230125020816 extends Version
{
    protected $description = "Добавление элементов к hl блоку GamesStudios";

    protected $moduleVersion = "4.2.4";

    private string $hlBlockName = 'GameStudios';

    /**
     * @return bool|void
     * @throws LoaderException
     */
    public function up()
    {
        ModuleHelper::loadHLModule();
        in_transaction(function () {
            $hlEntity = $this->getHlBlockEntityClass();

            $studios = [
                [
                    'UF_NAME' => 'Valve',
                    'UF_DESCRIPTION' => 'Valve Corporation - Американский разработчик видеоигр, издатель и цифровая дистрибьюторская компания со штаб-квартирой в Белвью, штат Вашингтон.',
                    'UF_FOUNDED_AT' => new Date('24.08.1996', 'd.m.Y'),
                ],
                [
                    'UF_NAME' => 'Blizzard',
                    'UF_DESCRIPTION' => 'Blizzard Entertainment - Аммериканская компания, одна из крупнейших в сфере компьютерных игр и развлечений со штаб-квартирой в Санта-Монике, Калифорния.',
                    'UF_FOUNDED_AT' => new Date('08.02.1991', 'd.m.Y'),
                ],
                [
                    'UF_NAME' => 'Electronic Arts',
                    'UF_DESCRIPTION' => 'Electronic Arts - Американская корпорация, занимающаяся распространением и изданием компьютерных игр со штаб-квартирой в Редвуд-Сити, штат Калифорния.',
                    'UF_FOUNDED_AT' => new Date('28.05.1982', 'd.m.Y'),
                ]

            ];

            foreach ($studios as $studio) {
                $res = $hlEntity::add($studio);
                if (!$res->isSuccess()) {
                    throw new Exception("Ошибка при добавлении игры в HL Block");
                }
            }
        });
    }

    public function down()
    {
        ModuleHelper::loadHLModule();
        in_transaction(function () {
            $hlEntity = $this->getHlBlockEntityClass();
            $elements = $hlEntity::getList(['select' => ['ID']])->fetchAll();
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
