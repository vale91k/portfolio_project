<?php

namespace Tasks;

class TimeIconClass
{
    /**
     * Задание:
     * Данный класс должен иметь метод, который отдаёт статичным методом ссылку на картинку в зависимости от того,
     * какое время сейчас. Например, метод будет отдавать 3 картинки, утреннюю, дневную, и ночную.
     * 1. Загрузить картинки в html/img
     * 2. Дописать метод getTimeIcon
     * 3. Через require на главную заимпортить данный класс и вызвать метод в вёрстке для получения ссылки на картинку
     */
    public static function getTimeIcon()
    {

        $curTime = date("H");
        if ($curTime > 0 and $curTime < 6) {
            $url = "../html/img/night.png";
        } elseif ($curTime >= 6 and $curTime < 12) {
            $url = "../html/img/morning.png";
        } elseif ($curTime >= 12 and $curTime < 23) {
            $url = "../html/img/dayly.png";
        } else {
            $url = "../html/img/night.png";
        }

        return $url;
    }
}
