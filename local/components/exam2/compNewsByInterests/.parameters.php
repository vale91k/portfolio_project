<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "NEWS_IBLOCK_ID" => [
            "NAME" => GetMessage("NEWS_INTERESTS_NEWS_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "PROPERTY_IBLOCK_CODE" => [
            "NAME" => GetMessage("NEWS_INTERESTS_PROPERTY_IBLOCK_CODE"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "USER_PROPERTY_CODE" => [
            "NAME" => GetMessage("NEWS_INTERESTS_USER_PROPERTY_CODE"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
	],
];