<?php
/**
 * При наличии $arResult["CANONICAL_LINK"], задает свойства на страницу с $arResult["CANONICAL_LINK"]
 */
if (isset($arResult["CANONICAL_LINK"])) {
    $APPLICATION->SetPageProperty("canonical", $arResult["CANONICAL_LINK"]);
}


if ($_GET["TYPE"] == "REPORT_RESULT"){

    if ($_GET["ID"]){
        echo '
             <script>
             var textElem = document.getElementById("ajax-report-text");
            textElem.innerText = "Ваше мнение учтено, № ' . $_GET["ID"] . '";
        window.history.pushState(null,null, "'.$APPLICATION->GetCurPage().'");
             </script>
        ';
    } else {
        echo '
             <script>
             var textElem = document.getElementById("ajax-report-text");
            textElem.innerText = "Ошибка!";
        window.history.pushState(null,null, "'.$APPLICATION->GetCurPage().'");
             </script>
        ';
    }
} else if (isset($_GET["ID"])){

    $jsonObject = [];

    if(CModule::IncludeModule("iblock")){
        $arUser = '';
        if($USER->IsAuthorized()){
            $arUser = $USER->GetID() . " (" . $USER->GetLogin() . ") " . $USER->GetFullName();
        } else {
            $arUser = "Не авторизирован";
        }

        $arField = [
            "IBLOCK_ID" => 7,
            "NAME" => "Новость" . $_GET["ID"],
            "ACTIVE_FROM" => \Bitrix\Main\Type\DateTime::createFromTimestamp(time()),
            "PROPERTY_VALUES" => [
                "USER" => $arUser,
                "NEWS" => $_GET["ID"]
            ]
        ];

        $element = new CIBlockElement(false);
        if ($elId = $element->Add($arField)){
            $jsonObject["ID"] = $elId;

            if ($_GET["TYPE"] == "REPORT_AJAX"){
                $APPLICATION->RestartBuffer();
                echo json_encode($jsonObject);
                die();
            }else if ($_GET["TYPE"] == "REPORT_GET"){
                LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT&ID=" . $jsonObject["ID"]);
            }
        } else {
            LocalRedirect($APPLICATION->GetCurPage() . "?TYPE=REPORT_RESULT");
        }
    }
}