<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>
<?php
$url = $APPLICATION->GetCurPage() . "?F=Y";
echo GetMessage("SIMPLECOMP_EXAM2_FILTER_TITLE") . "<a href='". $url . "'>" . $url . "</a>" . "</br>";
?>
<?php
if (count($arResult["NEWS"]) > 0) { ?>
    <ul>
        <?php foreach ($arResult["NEWS"] as $arNews) { ?>
            <li>
                <b>
                    <?= $arNews["NAME"]; ?>
                </b>
                <?= $arNews["ACTIVE_FROM"]; ?>
                <br>
                (<?= implode(", ",$arNews["SECTIONS"]); ?>)
            </li>
            <?php if (count($arNews["PRODUCTS"]) > 0) { ?>
                <ul>
                    <?php foreach ($arNews["PRODUCTS"] as $arProduct) { ?>
                        <li>
                            <?= $arProduct["NAME"]; ?> -
                            <?= $arProduct["PROPERTY_PRICE_VALUE"]; ?> -
                            <?= $arProduct["PROPERTY_MATERIAL_VALUE"]; ?> -
                            <?= $arProduct["PROPERTY_ARTNUMBER_VALUE"]; ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>
