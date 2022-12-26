<?php
error_reporting(1);

class WeatherClass
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';

    public static function nameOfCity($currCity = 'Magnitogorsk')
    {
        return $currCity;
    }

    public static function weatherData()
    {
        $url = self::BASE_URL . self::API_KEY . self::nameOfCity();
        return file_get_contents($url);
    }

    public static function parsingWeatherData()
    {
        $res = [];
        $arrInfo = explode(",", self::weatherData());
        foreach ($arrInfo as $some) {
            list($key, $value) = explode(':', $some);
            $res[$key] = $value;
        }
        return $res;
    }

}

$resultOfWeather = WeatherClass::parsingWeatherData();
$NameOfCity = WeatherClass::nameOfCity();
echo '<pre>';
print_r($resultOfWeather);
echo '</pre>';
?>
<div class="weather">
    <h2>Погода в городе <?= $NameOfCity; ?></h2>
    <p>Погода: <?= $resultOfWeather['"temp_c"']; ?>°C</p>
    <p>Влажность: <?= $resultOfWeather['"humidity"']; ?> %</p>
    <p>Ветер: <?= $resultOfWeather['"wind_kph"']; ?> км/ч</p>
</div>
