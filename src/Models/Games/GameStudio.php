<?php

namespace App\Models\GameStudios;
use App\Models\BitrixModelTrait;
use App\Models\Games\Table\GameStudioTable;

/**
 * Class GameStudio
 * @package App\Models\GameStudio
 */
class GameStudio extends GameStudioTable
{
    use BitrixModelTrait;
    public static function tableClass(): string
    {
        return GameStudioTable::class;
    }
}