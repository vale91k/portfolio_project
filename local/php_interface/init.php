<?php

/**
 * Подключение сервисных функций и событий.
 */
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
}
/**
 * Подключение файла событий
 */
if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/events.php")){
    require_once $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/events.php";
}

/**
 * Подключение вспомогательных функций
 */
require "helpers.php";