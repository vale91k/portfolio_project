<?php

namespace App\Models;

trait BitrixModelTrait
{
    public static function fetchById(int $id): array
    {
        return self::getById($id)->fetch();
    }

    public function fetchAllByFilter(array $filter) {
        // TODO исполнить реализацию
    }
}