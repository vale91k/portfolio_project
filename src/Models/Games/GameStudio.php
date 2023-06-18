<?php

namespace App\Models\Games;

use App\Models\BitrixModelTrait;


/**
 * Class GameStudio
 * @package App\Models\GameStudio
 */
class GameStudio extends GameStudioTable
{
    use BitrixModelTrait;

    /**
     * Возвращает имя класса таблицы.(Связь с таблицей)
     * @return string
     */
    public static function tableClass(): string
    {
        return GameStudioTable::class;
    }


}