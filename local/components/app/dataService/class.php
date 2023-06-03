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
     * @return mixed|void|null
     */
    public function executeComponent()
    {
        $this->dataService = new DataService();
        $this->arResult['ELEMENT_DATA'] = $this->getElementData();
        $this->arResult['MENU_ITEMS'] = $this->getMenuItems();
        $this->arResult['CATEGORY_ID'] = $this->getCategoryId();
//        $this->arResult['ARTICLE_ID'] = $this->getArticleId();
        $this->arResult['ITEMS'] = $this->getItems();
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
        return $_GET['category'] ? (int)$_GET['category'] : (int)$this->arResult['MENU_ITEMS'][0]['category_id'];
    }

//    /**
//     * Возвращает id артикля для детального текста
//     * @return int
//     */
//    private function getArticleId(): int
//    {
//        return $_GET['article'] ? (int)$_GET['article'] : (int)$this->arResult['ELEMENT_DATA'][0]['article_id'];
//    }
//    /**
//     *
//     * Возвращает ссылку для категорий
//     */
//    private function getLinkCategory()
//    {
//        return $APPLICATION->GetCurPage() . '?category=';
//    }
}