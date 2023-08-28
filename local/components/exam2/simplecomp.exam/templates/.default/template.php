<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>

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
                (<?= implode(", ", $arNews["SECTIONS"]); ?>)
            </li>
            <?php if (count($arNews["PRODUCTS"]) > 0) { ?>
                <ul id="<?= $this->GetEditAreaId("add_element"); ?>">
                    <?php foreach ($arNews["PRODUCTS"] as $arProduct) { ?>
                        <?php
                        $this->AddEditAction($arNews["ID"] . "_" . $arProduct['ID'], $arResult['ADD_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_ADD"));
                        $this->AddEditAction($arNews["ID"] . "_" . $arProduct['ID'], $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arNews["ID"] . "_" . $arProduct['ID'], $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arProduct["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li id="<?= $this->GetEditAreaId($arNews["ID"] . "_" . $arProduct['ID']); ?>">
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
