<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = [
	"APP_WEATHER_NAME" => GetMessage("WEATHER_NAME_BLOCK"),
	"WEATHER_DESCRIPTION" => GetMessage("WEATHER_BLOCK_DESCRIPTION"),
	"COMPLEX" => "Y",
	"PATH" => [
		"ID" => "content",
		"CHILD" => [
			"ID" => "news",
			"WEATHER_NAME" => GetMessage("T_WEATHER_BLOCK_DESC"),
			"SORT" => 10,
			"CHILD" => [
				"ID" => "news_cmpx",
			],
		],
	],
];

?>