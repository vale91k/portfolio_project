<?php

use Tasks\TimeIconClass;

require_once 'Tasks/TimeIconClass.php';
$urlToPicture = new TimeIconClass();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200;600&display=swap" rel="stylesheet">
    <title>Ivan's Blog</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="header__logo">Ivan's Blog</div>
            <img class="header__picture" src="<?= $urlToPicture->getTimeIcon(); ?>">
            <nav class="nav">
                <a class="nav__link" href="#">About</a>
                <a class="nav__link" href="#">Task1</a>
                <a class="nav__link" href="#">Task2</a>
                <a class="nav__link" href="#">Task3</a>
                <a class="nav__link" href="#">Task4</a>
            </nav>
        </div>
    </div>
</header>
<div class="main_page">
    <div class="container">
        <div class="main_page__inner">
            <h1 class="main_page__title">Welcome to my page</h1>
        </div>
    </div>
</div>

</body>
</html>