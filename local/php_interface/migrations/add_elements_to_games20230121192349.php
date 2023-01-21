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

class add_elements_to_games20230121192349 extends Version
{
    protected $description = "Добавление элементов к хл блоку games";

    protected $moduleVersion = "4.2.4";

    private string $hlBlockName = 'Games';

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
    public function up()
    {
        ModuleHelper::loadHLModule();
        in_transaction(function () {
            $hlEntity = $this->getHlBlockEntityClass();

            $games = [
                [
                    'UF_NAME' => 'Zero Tolerance',
                    'UF_DESCRIPTION' => 'Zero Tolerance — видеоигра в жанре шутера от первого лица, разработанная компанией Technopop (developer) и изданная Accolade 30 сентября 1994 года эксклюзивно для игровой приставки Mega Drive/Genesis. Игра является одним из очень немногих (всего пять игр) представителей жанра для Mega Drive/Genesis.',
                    'UF_RELEASED_AT' => new Date('30.09.1994', 'd.m.Y'),
                ],
                [
                    'UF_NAME' => 'Blue Stinger',
                    'UF_DESCRIPTION' => 'Blue Stinger - Вы играете роль Elliot Balade и его друга, моряка по имени Dogs, и должны избавить таинственный остров от мерзопакостных мутантов, расстреливая их, как только встретите. По ходу игры придется решать некоторые головоломки.',
                    'UF_RELEASED_AT' => new Date('25.04.1999', 'd.m.Y'),
                ]
            ];

            foreach ($games as $game) {
                $res = $hlEntity::add($game);
                if (!$res->isSuccess()) {
                    throw new Exception("Ошибка при добавлении игры в HL Block");
                }
            }
        });
    }

    /**
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
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

    /**
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
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
