<?php

use App\Services\DataService;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();


class DataServiceComponent extends \CBitrixComponent
{
    /**
     * Объект с методами класса с зоной видимостью protected
     * @var $dataService DataService
     */
    protected DataService $dataService;

    /**
     * Классик метод эксекьюта, КОТОРЫЙ все записывает в arResult, right?
     * @return mixed|void|null
     */
    public function executeComponent()
    {
        /*Создание объекта класса */
        $this->dataService = new DataService();
        /* Запись в arResult для будущего компонента detailText с метода */
        $this->arResult['ELEMENT_DATA'] = $this->getElementData();
        /*Данные с метода getMenuItems записывается в arResult['MENU_ITEMS']  */
        $this->arResult['MENU_ITEMS'] = $this->getMenuItems();
        /* Получения id категории в массив arResult для массива Items */
        $this->arResult['CATEGORY_ID'] = $this->getCategoryId();
        /* Получения артикля в массив arResult для массива element_data */
        $this->arResult['ARTICLE_ID'] = $this->getArticleId();
        /* Запись в arResult*/
        $this->arResult['ITEMS'] = $this->getItems();
//        $this->arResult['LINK'] = $this->getLinkCategory();
        /* Нестатичный метод для подключения шаблона компонента*/
        $this->includeComponentTemplate();
    }
    /**
     * Возвращает описания статей и их дату
     * @return array
     */
    private function getElementData(): array
    {
        return $this->dataService->getParsedDetailText($this->arParams['ARTICLE_ID']);
    }

    /**
     *  Возвращает названия категорий
     * @return array
     */
    private function getMenuItems(): array
    {
        return $this->dataService->getParsedListCategory();
    }

    /**
     *Возвращает массив заголовков с параметром id, чтобы можно было получать инфу с ссылки
     * @return array
     */
    private function getItems(): array
    {
        return $this->dataService->getCaptionsParsedList($this->arResult['CATEGORY_ID']);
    }

    /**
     * Возвращает методом get id категории, если он есть, если нет то берет id первого элемента arResult['menu_items'][category_id]
     * @return int
     */
    private function getCategoryId(): int
    {
        return $_GET['category'] ? (int)$_GET['category'] : (int)$this->arResult['MENU_ITEMS'][0]['category_id'];
    }

    /**
     * Пока не актуальный метод.
     * Возвращает id артикля для детального текста
     * @return int
     */
    private function getArticleId(): int
    {
        return $_GET['article'] ? (int)$_GET['article'] : (int)$this->arResult['ELEMENT_DATA'][0]['article_id'];
    }
    /**
     * Не актуальные метод.
     * Возвращает ссылку для категорий
     */
//    private function getLinkCategory()
//    {
//        return $APPLICATION->GetCurPage() . '?category=';
//    }
}