<?php


class Weather
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    const DEFAULT_CITY = 'Magnitogorsk';
    /**
     * Название города
     * @var string
     */
    private string $cityName;

    /**
     * Метод возвращает строку, которая несет в себе название города
     * @return string
     */
    public function getCityName(): string
    {
        if (empty($this->cityName)) {
            $this->setCityName(self::DEFAULT_CITY);
        }
        return $this->cityName;
    }

    /**
     * Устанавливает название города
     * @param string $cityName
     * @return $this
     */
    public function setCityName(string $cityName): Weather
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * Метод генерирует ссылку, по которой получим данные о погоде.
     * @return string
     */
    public function getWeatherUrl(): string
    {
        return $url = self::BASE_URL . self::API_KEY . $this->getCityName();
    }

    /**
     * Метод запрашивает данные о погоде.
     * @return mixed
     */
    private function requestWeatherData()
    {
        return json_decode(file_get_contents($this->getWeatherUrl()), true);
    }

    /**
     * Метод получает отфильтрованный массив с данными о погоде
     * @return array
     */
    public function getWeatherData(): array
    {
        $weatherData = $this->requestWeatherData();
        return [
            'location_name' => $weatherData["location"]["name"],
            'temp_c' => $weatherData["current"]["temp_c"],
            'humidity' => $weatherData["current"]["humidity"],
            'wind' => $weatherData["current"]["wind_kph"],
            'localTime' => $weatherData["location"]["localtime"],
            'icon' => $weatherData["current"]["condition"]["icon"],
        ];
    }
}

$weather = new Weather();
$weatherResult = $weather->getWeatherData();

echo '<pre>';
print_r($weatherResult);
echo '</pre>';


?>
<div class="weather">
    <h2>Погода в городе <?= $weatherResult["location_name"]; ?></h2>
    <p>Погода: <?= $weatherResult["temp_c"]; ?>°C</p>
    <p>Влажность: <?= $weatherResult["humidity"]; ?> %</p>
    <p>Ветер: <?= $weatherResult["wind"]; ?> км/ч</p>
    <p>Дата/Время: <?= $weatherResult["localTime"]; ?> </p>
</div>
