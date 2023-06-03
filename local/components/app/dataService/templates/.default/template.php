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
                       href="<?= $APPLICATION->GetCurPage() . '?category=' . $category['category_id']; ?>"
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
                    $exampleObject = new \App\Services\DataService();
                    foreach ($arResult['ITEMS'] as $key => $item) {
                        ?>
                        <div class="col-12 mt-3 mb-3">
                            <p href="/dataService/detail/?id=<?= $item['article_id']; ?>">
                            <h2><?= $item['name']; ?></h2>
                            <p><i><?= $exampleObject->getParsedDetailText($item['article_id'])['date']; ?></i></p>
                            <p><?= $exampleObject->getParsedDetailText($item['article_id'])['text']; ?></p>
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
