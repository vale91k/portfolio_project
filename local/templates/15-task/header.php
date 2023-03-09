<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Tasks\TimeIconClass;

Loc::loadMessages(__FILE__);
require_once 'tasks/TimeIconClass.php';


?>
<!doctype html>
<html lang="<?= LANGUAGE_ID; ?>">
<head>
    <?php
    $APPLICATION->ShowHead();
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/styles/css/style.css");
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200;600&display=swap" rel="stylesheet">
    <title>
        <?php
        $APPLICATION->ShowTitle();
        ?>
    </title>

</head>
<body>
<?php
$APPLICATION->ShowPanel();
?>
<div class="wrap">
    <div class="panel"></div>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__logo">
                    <a href="/" class="index_link"> <?= Loc::getMessage("HEADER_SITE_TITTLE"); ?></a>
                </div>
                <img class="header__picture" src="<?= TimeIconClass::getTimeIcon(); ?>">
                <nav class="nav">
                    <a class="nav__link" href="#">About</a>
                    <a class="nav__link" href="/dataService/index.php">Data Service</a>
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

