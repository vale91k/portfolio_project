<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = [
    "PARAMETERS" => [
        "PRODUCTS_IBLOCK_ID" => [
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_CATALOG_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "NEWS_IBLOCK_ID" => [
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_NEWS_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "PRODUCTS_IBLOCK_ID_PROPERTY" => [
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_CODE_PROPERTY_BINDING"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "CACHE_TIME" => ["DEFAULT" => 36000000],
    ],
];