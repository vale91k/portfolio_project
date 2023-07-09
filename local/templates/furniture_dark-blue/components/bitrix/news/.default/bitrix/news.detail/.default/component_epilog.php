<?php
/**
 * При наличии $arResult["CANONICAL_LINK"], задает свойства на страницу с $arResult["CANONICAL_LINK"]
 */
if (isset($arResult["CANONICAL_LINK"])) {
    $APPLICATION->SetPageProperty("canonical", $arResult["CANONICAL_LINK"]);
}