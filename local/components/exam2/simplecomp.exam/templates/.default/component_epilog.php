<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arResult["MIN_PRICE"]) && isset($arResult["MAX_PRICE"])) {
    $infoTemplate = "<div style=\"color:red; margin: 34px 15px 35px 15px\">#TEXT#</div>";
    $arText = GetMessage("SIMPLECOMP_EXAM2_MIN_PRICE") . $arResult["MIN_PRICE"] . "</br>" . GetMessage("SIMPLECOMP_EXAM2_MAX_PRICE") . $arResult["MAX_PRICE"];
    $resultText = str_replace("#TEXT#", $arText, $infoTemplate);
    $APPLICATION->AddViewContent("prices", $resultText);
}