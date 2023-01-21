<?php

namespace App\Helpers;

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

/**
 * Класс-помогалочка, используемый для модулей битрикса
 */
class ModuleHelper
{

    /**
     * Загружает модуль highloadblock или выбрасывает ошибку
     * @return void
     * @throws LoaderException
     */
    public static function loadHLModule(): void
    {
        if (!Loader::IncludeModule('highloadblock')) {
            throw new \Exception("Не удалось загрузить модуль highloadblock");
        }
    }
}