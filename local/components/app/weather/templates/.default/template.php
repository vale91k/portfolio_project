<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeTemplateLangFile(__FILE__);


/** @var $weatherService \App\Services\WeatherService */
$weatherService = $arResult['WEATHER_SERVICE'];

$this->addExternalCss("../.default/style.css");
?>
<link rel="stylesheet" href="../.default/style.css">
<div class="wrap_last">
    <div class="item text_1">
        <div class="h3_text">
            <h3>Current Weather <?= $weatherService->getLocationName()?></h3>
            <div class="icon">
                <img src="<?= $weatherService->getIconWeather()?>" alt="icon">
            </div>
            <h2><?=$weatherService->getTempValue()?>&#8451;</h2>
        </div>
        <ul class="text_decor">
          <li> Humidity: <?= $weatherService->getHumidityValue();?></li>
          <li> Wind: <?= $weatherService->getWindValue();?>km/h</li>
        </ul>

    </div>

</div>

</div>