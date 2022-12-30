<?php


class Weather
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    private $cityName;


    public function setCityName($cityName)
    {
        /*
         * Наработка сеттера, если понадобится проверка наличия города из бд
         * $result = $mysqli->query("SELECT * FROM Key WHERE Name LIKE '%".$Name."%'");
         * if ($result->num_rows > 0) {
         * do Something
         * }
         */
        return $this->cityName;
    }

    public function getCityName($cityName = 'Magnitogorsk'): string
    {
        return $this->cityName = $cityName;
    }

    public function getWeatherUrl(): string
    {
        return $url = self::BASE_URL . self::API_KEY . $this->getCityName();
    }

    public function getWeatherData()
    {
        return json_decode(file_get_contents($this->getWeatherUrl()), true);
    }

    public function getParsingWeatherData(): array
    {
        $weatherData = $this->getWeatherData();
        $res["location"] = $weatherData["location"]["name"];
        $res["temp_c"] = $weatherData["current"]["temp_c"];
        $res["humidity"] = $weatherData["current"]["humidity"];
        $res["wind"] = $weatherData["current"]["wind_kph"];
        $res["localTime"] = $weatherData["location"]["localtime"];
        $res["icon"] = $weatherData["current"]["condition"]["icon"];
        return $res;

    }

}

$weatherResult = new Weather();
$weatherResult = $weatherResult->getParsingWeatherData();

echo '<pre>';
print_r($weatherResult);
echo '</pre>';
?>
<div class="weather">
    <h2>Погода в городе <?= $weatherResult["location"]; ?></h2>
    <p>Погода: <?= $weatherResult["temp_c"]; ?>°C</p>
    <p>Влажность: <?= $weatherResult["humidity"]; ?> %</p>
    <p>Ветер: <?= $weatherResult["wind"]; ?> км/ч</p>
    <p>Дата/Время: <?= $weatherResult["localTime"]; ?> </p>
</div>
