<?php

use App\Services\DataService;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();


class DataServiceComponent extends \CBitrixComponent
{
    /**
     * Помогалочка для класса
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
        $this->arResult['ELEMENT_DATA'] = $this->dataService->getListDetailText($this->arParams['ARTICLE_ID']);
        /*Данные с метода getMenuItems записывается в arResult['MENU_ITEMS']  */
        $this->arResult['MENU_ITEMS'] = $this->getMenuItems();
        /* Запись в arResult*/
        $this->arResult['CATEGORY_ID'] = $this->getCategoryId();
        /* Запись в arResult*/
        $this->arResult['ITEMS'] = $this->getItems();
        /* Не понимаю зачем, но это по дефолту был*/
        $this->includeComponentTemplate();
    }


    private function getMenuItems(): array
    {
        return $this->dataService->getParsedListCategory();
    }

    /**
     *Возвращает заголовки с параметром id, чтобы можно было получать инфу с ссылки
     * @return array
     */
    private function getItems(): array
    {
        return $this->dataService->getCaptionsParsedList($this->arResult['CATEGORY_ID']);
    }

    /**
     * Возвращает методом get id - категории, если он есть, если нет то берет первый элемент arResult['menu_items'][category_id]
     * @return int
     */
    private function getCategoryId(): int
    {
        return $_GET['category'] ? (int)$_GET['category'] : (int)$this->arResult['MENU_ITEMS'][0]['category_id'];
    }
}