<?php



class Weather
{
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    /**
     * Поле класса для принятия названия города cityName. Может использоваться в запросах:
     * @var string
     * private getCityName
     * private setCityName
     */
    private $cityName;

    public function getCityName(): string
    {
        return $this->setCityName('Magnitogorsk');
    }

    public function setCityName(string $cityName): string
    {
        return $this->cityName = $cityName;
    }


    public function getWeatherUrl(): string
    {
        return $url = self::BASE_URL . self::API_KEY . self::getCityName();
    }

    private function requestWeatherData()
    {
        return json_decode(file_get_contents($this->getWeatherUrl()), true);
    }

    private function compressedWeatherData()
    {
        return $this->requestWeatherData();
    }

    public function getWeatherData(): array
    {

        $res["location"] = $this->compressedWeatherData()["location"]["name"];
        $res["temp_c"] = $this->compressedWeatherData()["current"]["temp_c"];
        $res["humidity"] = $this->compressedWeatherData()["current"]["humidity"];
        $res["wind"] = $this->compressedWeatherData()["current"]["wind_kph"];
        $res["localTime"] = $this->compressedWeatherData()["location"]["localtime"];
        $res["icon"] = $this->compressedWeatherData()["current"]["condition"]["icon"];
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
