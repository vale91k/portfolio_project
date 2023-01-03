<?php

namespace App\Api;

class Weather
{
    /**
     * Отдаёт данные в json формате, использует сервис погоды
     * @throws \Exception
     */
    public function getWeather(): string
    {
        if (rand(1, 10) === 5) {
            throw new \Exception('Ошибка при получении данных!');
        }

        return json_encode([
            'data' => [
                'degrees' => "-15"
            ]
        ]);
    }
}