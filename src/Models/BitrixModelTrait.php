<?php

namespace App\Models;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

trait BitrixModelTrait
{
    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function fetchById(int $id): array
    {
        return self::getById($id)->fetch();
    }

    public function filterElements(array $filter = [], array $select = ['ID']): array
    {
        return [];
        // TODO исполнить реализацию, по выборке и расфетчиванию элементов
    }
}