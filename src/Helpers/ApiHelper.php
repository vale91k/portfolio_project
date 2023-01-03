<?php

namespace App\Helpers;

/**
 * Класс-помогалочка, содержащий часто используемые методы-проверки для апи сервисов
 */
class ApiHelper
{

    /**
     * Проверяет, является ли переданная строка json форматом
     * @param string $json
     * @return bool
     */
    public static function isJson(string $json): bool
    {
        json_decode($json);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}