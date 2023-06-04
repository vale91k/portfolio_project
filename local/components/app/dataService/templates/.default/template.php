<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>


<body>
<div class="wrapper mb-5 mt-5">
    <div class="container_new">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php
                foreach ($arResult['MENU_ITEMS'] as $category) {
                    ?>
                    <a class="nav-item nav-link
                         <?php
                    if ($category['category_id'] === $arResult['CATEGORY_ID']) {
                        echo 'active';
                    }
                    ?>
                        "
                       href="<?= $arResult['LINK_CAT'] . $category['category_id']; ?>"
                       role="tab"
                       aria-controls="nav-<?= $category['category_id']; ?>"
                       aria-selected="false"><?= $category['name']; ?>
                    </a>
                <? } ?>
            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="row mb-4">
                    <?php
                    foreach ($arResult['ITEMS'] as $key => $item) {
                        ?>
                        <div class="col-12 mt-3 mb-3">
                            <p>
                            <h2><?= $item['name']; ?></h2>
                            <p><i><?= $item['date']; ?></i></p>
                            <p><?= $item['text']; ?></p>
                            </p>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
