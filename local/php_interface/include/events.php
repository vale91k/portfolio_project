<?php
AddEventHandler("main", "OnEpilog", ["Exam2", "Ex2_93"]);

class Exam2
{
    /**
     * Запись в журнал событий при посещении несуществующих страниц (как статических, так и динамических)
     */
    function Ex2_93(): void
    {
        // При получении ошибки 404
        if (defined("ERROR_404") && ERROR_404 == "Y") {

            //Отрисовка страницы 404 (Если страница динамическая, все равно отрисовывала 404 страницу, а не показывала отсутствие элемента)
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php";
            include $_SERVER["DOCUMENT_ROOT"] . "/404.php";
            include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/footer.php";

            //Запись в журнал
            CEventLog::Add([
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "DESCRIPTION" => GetMessage("ERROR_404_DESCRIPTION"),
            ]);
        }
    }
}