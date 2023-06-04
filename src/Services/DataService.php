<?php

namespace App\Services;

class DataService

{
    /**
     * @var string Логин для доступа
     */
    const LOGIN_KEY = 'labsales_test';
    /**
     * @var string Пароль для доступа
     */
    const PASS_KEY = '18765gR5';
    /**
     * @var string Ссылка для получения категорий
     */
    const URL_CATEGORIES = 'https://test.labsales.ru/tasks/articles/rest/categories';
    /**
     * @var string Ссылка для получения заголовков
     */
    const URL_CAPTION_CATEGORY = 'https://test.labsales.ru/tasks/articles/rest/category/';
    /**
     * @var string Ссылка для получения детального текста и даты статьи
     */
    const URL_DETAIL_DATA = 'https://test.labsales.ru/tasks/articles/rest/article/';
    /**
     * @var false|resource Curl подключение
     */
    private $curl_client;

    /**
     * Отключение коннекта
     */
    public function __destruct()
    {
        curl_close($this->curl_client);
    }

    /**
     * DataService constructor. Подключение
     */
    public function __construct()
    {
        $obj = curl_init();
        curl_setopt($obj, CURLOPT_USERPWD, self::LOGIN_KEY . ":" . self::PASS_KEY);
        curl_setopt($obj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($obj, CURLOPT_HEADER, 0);
        $this->curl_client = $obj;
    }

    /**
     * Подключение к названиям категорий
     * @return mixed
     */
    public function getListCategory(): array
    {
        curl_setopt($this->curl_client, CURLOPT_URL, self::URL_CATEGORIES);
        $output = curl_exec($this->curl_client);
        return json_decode($output, true);
    }

    /**
     * Получение названий категорий в массиве
     * @return array
     */
    public function getParsedListCategory(): array
    {
        $parData = $this->getListCategory();
        return $parData['data'];
    }

    /**
     * Подключение к заголовкам
     * @param $categoryId
     * @return mixed
     */
    public function getCaptionsList($categoryId): array
    {
        curl_setopt($this->curl_client, CURLOPT_URL, self::URL_CAPTION_CATEGORY . $categoryId . '/');
        $output = curl_exec($this->curl_client);
        return json_decode($output, true);
    }

    /**
     * Получение заголовков по id категорий в массиве
     * @param $categoryId
     * @return array
     */
    public function getCaptionsParsedList($categoryId): array
    {
        $parData = $this->getCaptionsList($categoryId);
        return $parData['data'];
    }

    /**
     * Подключение к детальному тексту и дате
     * @param $id
     * @return mixed
     */
    public function getListDetailText($id): array
    {
        curl_setopt($this->curl_client, CURLOPT_URL, self::URL_DETAIL_DATA . $id . '/');
        $output = curl_exec($this->curl_client);
        return json_decode($output, true);
    }

    /**
     * Получение детального текста и даты в массиве
     * @param $articleId
     * @return array
     */
    public function getParsedDetailText($articleId): array
    {
        $parData = $this->getListDetailText($articleId);
        return $parData['data'];
    }
}
