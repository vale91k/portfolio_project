<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    ---
    </br>
    <p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE_71")?></b></p>
    <?php
        if (count($arResult["CLASSIFIER"]) > 0) {
    ?>
            <ul>
                <?php
                foreach ($arResult["CLASSIFIER"] as $arClassifier) {
                ?>
                <li>
                    <b>
                        <?= $arClassifier["NAME"]; ?>
                    </b>
                    <?php if (count($arClassifier["ELEMENTS"]) > 0) { ?>
                    <ul>
                        <?php foreach ($arClassifier["ELEMENTS"] as $arItems) { ?>
                        <li>
                            <?= $arItems["NAME"];?>
                            <?= $arItems["PROPERTY"]["PRICE"]["VALUE"];?> -
                            <?= $arItems["PROPERTY"]["MATERIAL"]["VALUE"];?> -
                            <?= $arItems["PROPERTY"]["ARTNUMBER"]["VALUE"];?> -
                            <a href="<?= $arItems["DETAIL_PAGE_URL"];?>">Ссылка на детальный просмотр</a>
                        </li>
                        <? } ?>
                    </ul>
                    <? } ?>
                </li>
                <? } ?>
            </ul>
<?php } ?>
