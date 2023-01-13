<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");


use App\Services\WeatherService;
use App\Weather;

$APPLICATION->IncludeComponent(
    "app:weather",
    "",
    array(),
    false
);
//TODO Стереть после ознакомления
Weather::test();

?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>