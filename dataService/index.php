<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Data-Service");

$APPLICATION->IncludeComponent(
    "app:dataService",
    "",
    [],
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

