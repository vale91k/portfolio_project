<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ivan's Blog");


use App\Services\WeatherService;
use App\Weather;


//TODO Стереть после ознакомления
Weather::test();
?>


<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>

