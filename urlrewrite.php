<?
$arUrlRewrite = [
    [
        "CONDITION" => "#^/services/#",
        "RULE" => "",
        "ID" => "bitrix:catalog",
        "PATH" => "/services/index.php",
    ],
    [
        "CONDITION" => "#^/products/#",
        "RULE" => "",
        "ID" => "bitrix:catalog",
        "PATH" => "/products/index.php",
    ],
    [
        'CONDITION' => '#^/api/#',
        'RULE' => '',
        'ID' => NULL,
        'PATH' => '/bitrix/services/api/index.php',
        'SORT' => 100,
    ],
    [
        "CONDITION" => "#^/news/#",
        "RULE" => "",
        "ID" => "bitrix:news",
        "PATH" => "/news/index.php",
    ],
    [
        'CONDITION' => '#^/api/#',
        'RULE' => '',
        'ID' => NULL,
        'PATH' => '/api/index.php',
        'SORT' => 100,
    ],

];