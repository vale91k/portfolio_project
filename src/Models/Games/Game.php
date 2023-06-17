<?php

namespace App\Models\Games;

use App\Models\BitrixModelTrait;

/**
 * Class Game
 *
 * @package App\Models\Games
 **/
class Game extends GameTable
{
    use BitrixModelTrait;

    /**
     * Возвращает имя класса таблицы.(Связь с таблицей)
     * @return string
     */
    public static function tableClass(): string
    {
        return GameTable::class;
    }
}