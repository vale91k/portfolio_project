<?php

use App\Services\DataService;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();


class DataServiceComponent extends \CBitrixComponent
{
    /**
     * @var $dataService DataService
     */
    protected DataService $dataService;

    /**
     * @return void
     */
    public function executeComponent()
    {
        $this->dataService = new DataService();
        $this->arResult['MENU_ITEMS'] = $this->getMenuItems();
        $this->arResult['CATEGORY_ID'] = $this->getCategoryId();
        $this->arResult['LINK_CAT'] = $this->getLinkCategory();
        $this->arResult['ITEMS'] = $this->getItems();
        $this->fillItems();
        $this->includeComponentTemplate();
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
     * Возвращает массив заголовков с параметром id
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
        return $_GET['category'] ? (int)$_GET['category'] : (int)$this->arResult['ITEMS'][0]['category_id'];
    }

    /**
     *
     * Возвращает ссылку для категорий
     */
    private function getLinkCategory(): string
    {
        global $APPLICATION;
        return $APPLICATION->GetCurPage() . '?category=';
    }

    /**
     * Заполняет массив ITEMS детальным текстом и датой
     */
    private function fillItems()
    {
        foreach ($this->arResult['ITEMS'] as &$key) {
            $key['date'] = $this->dataService->getParsedDetailText($key['article_id'])['date'];
            $key['text'] = $this->dataService->getParsedDetailText($key['article_id'])['text'];
        }
    }

}