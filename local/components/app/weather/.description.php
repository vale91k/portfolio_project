<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = [
	"NAME" => GetMessage("APP_WEATHER_NAME"),
	"DESCRIPTION" => GetMessage("APP_WEATHER_DESCRIPTION"),
	"PATH" => [
		"ID" => "weather",
        "NAME" => GetMessage("APP_WEATHER_PATH_NAME")
	],
];

?>