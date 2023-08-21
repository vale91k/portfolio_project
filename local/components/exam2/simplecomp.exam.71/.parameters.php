<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = [
	"PARAMETERS" => [
		"PRODUCTS_IBLOCK_ID" => [
			"NAME" => GetMessage("CLASSCOMP_EXAM2_CAT_IBLOCK_ID"),
            "PARENT" => "BASE",
			"TYPE" => "STRING",
		],
        "CLASSIFIER_IBLOCK_ID" => [
            "NAME" => GetMessage("CLASSCOMP_EXAM2_CLASSIFIER_IBLOCK_ID"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "TEMPLATE_DETAIL" => [
            "NAME" => GetMessage("CLASSCOMP_EXAM2_TEMPLATE_DETAIL"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "PROPERTY_CODE" => [
            "NAME" => GetMessage("CLASSCOMP_EXAM2_PROPERTY_BINDING"),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
        ],
        "CACHE_TIME" => ["DEFAULT" => 36000000],
        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CLASSCOMP_EXAM2_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
	],
];