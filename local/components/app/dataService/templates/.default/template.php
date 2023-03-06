<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/** @var $dataService \App\Services\DataService */

$dataService = $arResult['DATA_SERVICE'];
$arCaptionList = $dataService->getParsedListCategory();
$arCaptionName = $dataService->getCaptionsParsedList($id = Null);
?>


</head>
<body>
<div class="wrapper mb-5 mt-5">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php
                foreach ($arCaptionList as $k => $category) {
                    ?>
                    <a class="nav-item nav-link
                         <?php
                    if ($k === 0) {
                        echo 'active';
                    }
                    ?>
                         " id="nav-<?= $category['category_id']; ?>-tab" data-toggle="tab"
                       href="#nav-<?= $category['category_id']; ?>" role="tab"
                       aria-controls="nav-<?= $category['category_id']; ?>"
                       aria-selected="false"><?= $category['name']; ?>
                    </a>
               <? } ?>

            </div>

        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-1" role="tabpanel">
                <div class="row mb-4">
                    <?php
                    foreach ($arCaptionName(1) as $k => $elementName) {
                        ?>
                        <div class="col-12 mt-3 mb-3">
                            <h2><?= $elementName['name']; ?></h2>
                            <p><i>Дата статьи</i></p>
                            <p>Описание статьи</p>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-2" role="tabpanel">
                <div class="row mb-4">
                    <?php
                    foreach ($arCaptionName(2) as $k => $elementName) {
                        ?>
                        <div class="col-12 mt-3 mb-3">
                            <h2><?= $elementName['name']; ?></h2>
                            <p><i>Дата статьи</i></p>
                            <p>Описание статьи</p>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-3" role="tabpanel">
                <div class="row mb-4">
                    <?php
                    foreach ($arCaptionName(3) as $k => $elementName) {
                        ?>
                        <div class="col-12 mt-3 mb-3">
                            <h2><?= $elementName['name']; ?></h2>
                            <p><i>Дата статьи</i></p>
                            <p>Описание статьи</p>
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
