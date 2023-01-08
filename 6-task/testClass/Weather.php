<?php


class Weather
{
    /**
     * @var string Ключ для генерации ссылки
     */
    const API_KEY = '76eaa38077084ff9b6895618221212&q=';
    /**
     * @var string Url для генерации ссылки
     */
    const BASE_URL = 'http://api.weatherapi.com/v1/current.json?key=';
    /**
     * @var string Дефолтное название города
     */
    const DEFAULT_CITY = 'Magnitogorsk';
    /**
     * Название города
     * @var string
     */
    private string $cityName;
    /**
     * Название города с приходящего массива с данными
     * @var string
     */
    private string $locationName;
    /**
     * Температура цельсия
     * @var string
     */
    private string $tempValue;
    /**
     * Влажность погоды
     * @var string
     */
    private string $humidityValue;
    /**
     * Скорость ветра
     * @var string
     */
    private string $windValue;
    /**
     * Текущее время в городе
     * @var string
     */
    private string $localTime;
    /**
     * Иконка погоды
     * @var string
     */
    private string $iconWeather;

    /**
     * Weather constructor.
     */
    public function __construct()
    {
        $this->getWeatherData();
    }

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
     * Возвращаеет строку, навзание города с массива данных
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName;
    }

    /**
     * Устанавливает название города
     * @param string $locationName
     * @return $this
     */
    public function setLocationName(string $locationName): Weather
    {
        $this->locationName = $locationName;
        return $this;
    }

    /**
     * Возвращает температуру цельсия
     * @return string
     */
    public function getTempValue(): string
    {
        return $this->tempValue;
    }

    /**
     * Устанавливает температуру с массива данных
     * @param string $tempValue
     * @return $this
     */
    public function setTempValue(string $tempValue): Weather
    {
        $this->tempValue = $tempValue;
        return $this;
    }

    /**
     * Возвращает влажность температуры
     * @return string
     */
    public function getHumidityValue(): string
    {
        return $this->humidityValue;
    }

    /**
     * Устанавливает влажность температуры
     * @param string $humidityValue
     * @return $this
     */
    public function setHumidityValue(string $humidityValue): Weather
    {
        $this->humidityValue = $humidityValue;
        return $this;
    }

    /**
     * Возвращает скорость ветра
     * @return string
     */
    public function getWindValue(): string
    {
        return $this->windValue;
    }

    /**
     * Устанавливает скорость ветра
     * @param string $windValue
     * @return $this
     */
    public function setWindValue(string $windValue): Weather
    {
        $this->windValue = $windValue;
        return $this;
    }

    /**
     * Возвращает местное время
     * @return string
     */
    public function getLocalTime(): string
    {
        return $this->localTime;
    }

    /**
     * Устанавливает местное время
     * @param string $localTime
     * @return $this
     */
    public function setLocalTime(string $localTime): Weather
    {
        $this->localTime = $localTime;
        return $this;
    }

    /**
     * Возвращает иконку погоды
     * @return string
     */
    public function getIconWeather(): string
    {
        return $this->iconWeather;
    }

    /**
     * Устанавливает иконку погоды
     * @param string $iconWeather
     * @return $this
     */
    public function setIconWeather(string $iconWeather): Weather
    {
        $this->iconWeather = $iconWeather;
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
     * @return Weather
     */
    public function getWeatherData(): Weather
    {
        $weatherData = $this->requestWeatherData();
        $this->setLocationName($weatherData["location"]["name"]);
        $this->setTempValue($weatherData["current"]["temp_c"]);
        $this->setHumidityValue($weatherData["current"]["humidity"]);
        $this->setWindValue($weatherData["current"]["wind_kph"]);
        $this->setLocalTime($weatherData["location"]["localtime"]);
        $this->setIconWeather($weatherData["current"]["condition"]["icon"]);
        return $this;

    }
}

$weather = new Weather();
echo '<pre>';
var_dump($weather);
echo '</pre>';


?>
<div class="weather">
    <h2>Погода в городе <?= $weather->getLocationName(); ?></h2>
    <p>Погода: <?= $weather->getTempValue(); ?>°C</p>
    <p>Влажность: <?= $weather->getHumidityValue() ?> %</p>
    <p>Ветер: <?= $weather->getWindValue() ?> км/ч</p>
    <p>Дата/Время: <?= $weather->getLocalTime() ?> </p>
    <img class="header__picture" src="<?= $weather->getIconWeather(); ?>">
</div>
