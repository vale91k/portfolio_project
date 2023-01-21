<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\DB\Connection;
use Bitrix\Main\Application;

function db(string $name = ''): Connection
{
    return Application::getConnection($name);
}

/**
 * Выполняет лямбда-функцию в транзакции.
 *
 * @param callable $executor
 * @param array $args
 *
 * @return mixed
 * @throws \Exception
 */
function in_transaction(callable $executor, array $args = [])
{
    db()->startTransaction();
    try {
        $result = call_user_func_array($executor, $args);
        db()->commitTransaction();

        return $result;
    } catch (Exception $e) {
        db()->rollbackTransaction();
        throw $e;
    }
}

/**
 * Получаем обьект сущности HL блока по ID
 *
 * @param int $hlblockId
 * @return mixed
 * @throws \Bitrix\Main\ArgumentException
 * @throws \Bitrix\Main\ObjectPropertyException
 * @throws \Bitrix\Main\SystemException
 */
function getHLBlockEntityById(int $hlblockId) :Bitrix\Main\ORM\Data\DataManager
{
    $hlblock = HighloadBlockTable::getById($hlblockId)->fetch();
    /** @var $entity Bitrix\Main\ORM\Entity */
    $entity = HighloadBlockTable::compileEntity($hlblock);
    $className = $entity->getDataClass();
    return new $className();
}
