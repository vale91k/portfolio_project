<?php

/**
 * Если в массиве установлен ключ DATE_FIRST_NEWS, то устанавливаем значения (на страницу) в specialdate с DATE_FIRST_NEWS (дата первой новости)
 */
if (isset($arResult["DATE_FIRST_NEWS"])) {
    $APPLICATION->SetPageProperty("specialdate", $arResult["DATE_FIRST_NEWS"]);
}