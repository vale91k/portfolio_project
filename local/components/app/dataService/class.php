<?php

use App\Services\DataService;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();


class DataServiceComponent extends CBitrixComponent
{
    /**
     * @var $dataService DataService
     */
    protected DataService $dataService;

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        $this->dataService = new DataService();
        $this->arResult['MENU_ITEMS'] = $this->getMenuItems();
        $this->arResult['CATEGORY_ID'] = $this->getCategoryId();
        $this->arResult['ITEMS'] = $this->getItems();
        $this->fillItems();
        $this->fillMenuItems();
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
     * Заполняет массив MENU_ITEMS ссылкой для категорий
     */
    private function fillMenuItems(): void
    {
        global $APPLICATION;
        foreach ($this->arResult['MENU_ITEMS'] as &$category) {
            $category['link'] = $APPLICATION->GetCurPage() . '?category=' . $category['category_id'];
        }

    }

    /**
     * Заполняет массив ITEMS детальным текстом и датой
     */
    private function fillItems(): void
    {
        foreach ($this->arResult['ITEMS'] as &$item) {
            $item['date'] = $this->dataService->getParsedDetailText($item['article_id'])['date'];
            $item['text'] = $this->dataService->getParsedDetailText($item['article_id'])['text'];
        }
    }

}