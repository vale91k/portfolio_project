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
        if ($curTime >= 0 && $curTime < 6) {
            $url = SITE_TEMPLATE_PATH . "/styles/images/night.png";
        } elseif ($curTime >= 6 && $curTime < 12) {
            $url = SITE_TEMPLATE_PATH . "/styles/images/morning.png";
        } elseif ($curTime >= 12 && $curTime < 23) {
            $url = SITE_TEMPLATE_PATH . "/styles/images/dayly.png";
        } else {
            $url = SITE_TEMPLATE_PATH . "/styles/images/night.png";
        }
        return $url;
    }
}

