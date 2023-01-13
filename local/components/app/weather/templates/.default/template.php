<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var $weatherService \App\Services\WeatherService */
$weatherService = $arResult['WEATHER_SERVICE'];
?>
<div>
    <?= $weatherService->getLocationName(); ?>
</div>