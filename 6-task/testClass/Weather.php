<?php


class Weather
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    /**
     * Поле несет в себе название города.
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
            return $this->cityName = 'Magnitogorsk';
        }
        return $this->cityName;
    }

    /**
     * Метод устанавливает название города, на вход принимает название города (только строку).
     * @param string $cityName
     * @return $this
     */
    public function setCityName(string $cityName)
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
        return $url = self::BASE_URL . self::API_KEY . self::getCityName();
    }

    /**
     * Метод формирует массив с ссылки, которую получили методом getWeatherUrl().
     * @return mixed
     */
    private function requestWeatherData()
    {
        return json_decode(file_get_contents($this->getWeatherUrl()), true);
    }

    /**
     * Метод получает отфильтрованный массив с нужными данными о погоде
     * @return array
     */
    public function getWeatherData(): array
    {
        $weatherData = $this->requestWeatherData();
        $res =[
            'location' => $weatherData["location"]["name"],
            'temp_c' => $weatherData["current"]["temp_c"],
            'humidity' => $weatherData["current"]["humidity"],
            'wind' => $weatherData["current"]["wind_kph"],
            'localTime' => $weatherData["location"]["localtime"],
            'icon' => $weatherData["current"]["condition"]["icon"],
        ];
        return $res;
    }
}

$weatherResult = new Weather();
$weatherResult = $weatherResult->getWeatherData();

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
