<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/** @var $weatherService \App\Services\WeatherService */

$weatherService = $arResult['WEATHER_SERVICE'];
?>

<div class="wrap_last">
    <div class="item text_1">
        <div class="h3_text">
            <h3><?= Loc::getMessage("CURRENT_WEATHER") . $weatherService->getLocationName(); ?></h3>
            <div class="icon">
                <img src="<?= $weatherService->getIconWeather() ?>" alt="icon">
            </div>
            <h2><?= $weatherService->getTempValue() ?>&#8451;</h2>
        </div>
        <ul class="text_decor">
            <li> <?= Loc::getMessage("CURRENT_HUMIDITY") . $weatherService->getHumidityValue(); ?> &#37;</li>
            <li> <?= Loc::getMessage("CURRENT_WIND") . $weatherService->getWindValue() ?> km/h</li>
        </ul>

    </div>

</div>

