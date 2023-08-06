<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ivan's Blog");
?>
    <div class="main_page">
        <div class="container">
            <div class="main_page__inner">
                <h1 class="main_page__title">Welcome to my page</h1>
                <?php
                $arr = [1,2,3,4,4,4,5,6,7,8,9,9,9];

                // Считаем количество значений
                $count_values = array_count_values($arr);

//                print_r($count_values);

                // Фильтруем те которых больше 1
                $repits = array_filter($count_values, fn($el) => $el == 1);

                echo '<pre>';
                print_r($repits);
                echo '</pre>';
                ?>
            </div>
        </div>
    </div>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");