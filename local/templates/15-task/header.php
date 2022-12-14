<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
IncludeTemplateLangFile(__FILE__);

use Bitrix\Main\Page\Asset;

?>
<?php


use Tasks\TimeIconClass;

require_once 'tasks/TimeIconClass.php';


?>
<!doctype html>
<html lang="<?= LANGUAGE_ID; ?>">
<head>
    <? $APPLICATION->ShowHead(); ?>

    <?
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/styles/css/style.css");
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200;600&display=swap" rel="stylesheet">
    <title><? $APPLICATION->ShowTitle(); ?></title>

</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<div class="wrap">
    <div class="panel"></div>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__logo">
                    <a href="/" class="index_link"> Ivan's Blog</a>
                </div>
                <img class="header__picture" src="<?= TimeIconClass::getTimeIcon(); ?>">
                <nav class="nav">
                    <a class="nav__link" href="#">About</a>
                    <a class="nav__link" href="#">Task1</a>
                    <a class="nav__link" href="#">Task2</a>
                    <a class="nav__link" href="#">Task3</a>
                    <a class="nav__link" href="#">Task4</a>
                </nav>
            </div>
            <input type="checkbox" id="modal">
            <label class="nav__link" for="modal">Связь со мной</label>
            <form action="" class="popup">
                <span>Связь со мной</span>
                <a class="cont__link" href="#">Телега</a>
                <a class="cont__link" href="#">Вк</a>
                <a class="cont__link" href="#">Почта</a>
            </form>
        </div>
    </header>
    <div class="main_page">
        <div class="container">

            <div class="main_page__inner">
                <h1 class="main_page__title">Welcome to my page</h1>
            </div>
        </div>
    </div>


