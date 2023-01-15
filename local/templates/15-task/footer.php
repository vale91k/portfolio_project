<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

</html>

<footer>
    <?
    $APPLICATION->IncludeComponent(
        "app:weather",
        "",
        array(),
        false
    );
    ?>


</footer>

</div>

</body>
