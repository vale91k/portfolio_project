<?php

namespace App\Models\Games;
use App\Models\BitrixModelTrait;
use App\Models\Games\Table\GameTable;

/**
 * Class Game
 *
 * @package App\Models\Games
 **/
class Game extends GameTable
{
    use BitrixModelTrait;
    /**
     * Возвращает имя класса таблицы.(Свзязь с таблицей)
     * @return string
     */
    public static function tableClass(): string
    {
        return GameTable::class;
    }
}