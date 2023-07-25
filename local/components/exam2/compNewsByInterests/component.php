<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
    return;
}

// Установка параметров, если они не заданы
if ($arParams["CACHE_TIME"]) {
    $arParams["CACHE_TIME"] = 36000000;
}
if ($arParams["NEWS_IBLOCK_ID"]) {
    $arParams["NEWS_IBLOCK_ID"] = 1;
}
global $USER;
if ($USER->isAuthorized()) {
    $arResult["COUNT"] = 0;
    $currentUserId = $USER->GetID();
    $currentUserType = CUser::GetList(
        "id",
        "asc",
        ["ID" => $currentUserId],
        ["SELECT" => [$arParams["USER_PROPERTY_CODE"]]]

    )->Fetch()[$arParams["USER_PROPERTY_CODE"]];

    if ($this->StartResultCache(false, [$currentUserType, $currentUserId])) {

        // user
        $rsUsers = CUser::GetList(
            "id",
            "desc",

            [
                $arParams["PROPERTY_UF"] => $currentUserType,
// Исключение Новостей для текущего пользователя
//                "!ID" => $currentUserId,
            ],
            [
                "SELECT" => ["LOGIN", "ID"]
            ]
        );
        // выбираем пользователей
        while ($arUser = $rsUsers->Fetch()) {
            $userList[$arUser["ID"]] = ["LOGIN" => $arUser["LOGIN"]];
            $userListId[] = $arUser["ID"];
        }
        $arNewsAuthor = [];
        $arNewsList = [];
        $rsElements = CIBlockElement::GetList(
            [],
            [
                "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
                "PROPERTY_" . $arParams["PROPERTY_IBLOCK_CODE"] => $userListId
            ],
            false,
            false,
            [
                "NAME",
                "ACTIVE_FROM",
                "ID",
                "IBLOCK_ID",
                "PROPERTY_" . $arParams["PROPERTY_IBLOCK_CODE"]
            ]
        );
        $arNewsId = [];

        while ($arElement = $rsElements->Fetch()) {
            //Распределение новостей по авторам id
            $arNewsAuthor[$arElement["ID"]][] = $arElement["PROPERTY_" . $arParams["PROPERTY_IBLOCK_CODE"] . "_VALUE"];

            if (empty($arNewsList[$arElement["ID"]])) {
                $arNewsList[$arElement["ID"]] = $arElement;
            }
            if ($arElement["PROPERTY_" . $arParams["PROPERTY_IBLOCK_CODE"] . "_VALUE"] != $currentUserId) {
                $arNewsList[$arElement["ID"]]["AUTHORS"][] = $arElement["PROPERTY_" . $arParams["PROPERTY_IBLOCK_CODE"] . "_VALUE"];
            }
        }

        foreach ($arNewsList as $key => $value) {
            if (in_array($currentUserId, $arNewsAuthor[$value["ID"]])) {
                continue;
            }

            foreach ($value["AUTHORS"] as $authorId) {
                $userList[$authorId]["NEWS"][] = $value;
                $arNewsId[$value["ID"]] = $value["ID"];
            }
        }



        unset($userList[$currentUserId]);
        $arResult["AUTHORS"] = $userList;
        $arResult["COUNT"] = count($arNewsId);
        $this->SetResultCacheKeys(["COUNT"]);
        $this->includeComponentTemplate();


    } else {

        $this->abortResultCache();
    }
    $APPLICATION->SetTitle(GetMessage("COUNT_97") . $arResult["COUNT"]);
}
