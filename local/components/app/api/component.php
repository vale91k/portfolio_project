<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application;
use App\Helpers\ApiHelper;

header('Content-Type: application/json; charset=utf-8');

$request = Application::getInstance()->getContext()->getRequest();
$params = $request->toArray();

// Разбиваем адрес в запросе
$splitUrl = explode('/', urldecode($request->getRequestedPage()));

// Имя вызываемого класса
$class = "App\Api\\" . ucfirst($splitUrl[2]);
// Метод
$method = $splitUrl[3];

try {
    $api = new $class();
    $result = $api->$method($params);
} catch (Exception $e) {

    $data = $e->getMessage();

    if (ApiHelper::isJson($data)) {
        $error = json_decode($data);
    } else {
        $error = $data;
    }

    echo json_encode(
        [
            'result' => 'error',
            'error' => $error
        ]
    );
}

echo $result;