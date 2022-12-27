<?php


class Weather
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    private $city;

    public function getCityName()
    {                               /*  Наработка для геттера и сеттера */
        return $this->city;
    }

    public function __construct($city = 'Magnitogorsk')
    {
        $this->city = $city;                /*  Наработка для геттера и сеттера */
    }

    public static function cityName($city = 'Erevan')
    {
        return $city;
    }

    public static function weatherData()
    {
        $url = self::BASE_URL . self::API_KEY . self::cityName();
        return json_decode(file_get_contents($url), true);
    }

    public static function getParsingWeatherData()
    {
        $weatherData = self::weatherData();
        $res["location"] = $weatherData["location"]["name"];
        $res["temp_c"] = $weatherData["current"]["temp_c"];
        $res["humidity"] = $weatherData["current"]["humidity"];
        $res["wind"] = $weatherData["current"]["wind_kph"];
        $res["localTime"] = $weatherData["location"]["localtime"];
        $res["icon"] = $weatherData["current"]["condition"]["icon"];
        return $res;

    }

}

$resultOfWeather = Weather::getParsingWeatherData();
echo '<pre>';
print_r($resultOfWeather);
echo '</pre>';
?>
<div class="weather">
    <h2>Погода в городе <?= $resultOfWeather["location"]; ?></h2>
    <p>Погода: <?= $resultOfWeather["temp_c"]; ?>°C</p>
    <p>Влажность: <?= $resultOfWeather["humidity"]; ?> %</p>
    <p>Ветер: <?= $resultOfWeather["wind"]; ?> км/ч</p>
    <p>Дата/Время: <?= $resultOfWeather["localTime"]; ?> </p>
</div>
