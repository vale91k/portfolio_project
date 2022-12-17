<?php

namespace Weather;

/**
 * Класс для получения и отдачи погоды
 */
class WeatcherClass
{
    const API_KEY = '76eaa38077084ff9b6895618221212';
    const BASE_URL = 'http://api.weatherapi.com/v1';

    /**
     * Реализовать метод, который будет отдавать массив с текущей погодой, в зависимости от того что нам будет API отдавать
     * придумать структуру массива, чтобы было потом удобнее в шаблоне его применять
     */
    public static function getWeatcherInfo()
    {
        // TODO сделать получение и распарсингование данных, после метода по генерации ссылки
        var_dump(file_get_contents(self::getLink()));
    }

    /**
     * В общем за погодой мы идём по адресу http://api.weatherapi.com/v1/current.json?key=<YOUR_API_KEY>&q=London
     * Этот метод нам должен отдавать норм ссылку для получения. Как видишь в полях у нас уже есть наш API_KEY.
     * Но погода нам разве нужна для London'a ? Город добавь тоже в константы класса и генерируй ссылку, чтобы на выходе было
     * https://api.weatherapi.com/v1/current.json?key=76eaa38077084ff9b6895618221212&q=Magnitogorsk
     */
    private static function getLink()
    {
        $url = '';
        // TODO сделать генерацию ссылки
        return $url;
    }
}