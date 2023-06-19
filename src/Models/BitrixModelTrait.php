<?php

namespace App\Models;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;


trait BitrixModelTrait
{
    /**
     * Расфетчивание элементов по id
     *
     * @param int $id
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function fetchById(int $id): array
    {
        return self::getById($id)->fetch();
    }

    /**
     * Выборка с фильтром и расфетчиванием элементов
     *
     * @param array $filter
     * @param array|string[] $select
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function filterElements(array $filter = [], array $select = ['ID']): array
    {
        return self::getList([
            'filter' => $filter,
            'select' => $select
        ])->fetchAll();
    }
}