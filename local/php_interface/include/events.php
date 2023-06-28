<?php

AddEventHandler("main", "OnBeforeEventAdd", ["Exam2", "Ex2_51"]);

class Exam2
{
    /**
     * Запись в журнал событий при отправке писем с компонента bitrix:main.feedback
     * @param string $event Идентификатор почтового события
     * @param string $lid Id сайта
     * @param array $arFields Массив параметров
     */
    function Ex2_51(string &$event, string &$lid, array &$arFields): void
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            // Если авторизован
            if ($USER->IsAuthorized()) {
                $arFields["AUTHOR"] = GetMessage("EX2_51_AUTH", [
                    '#ID#' => $USER->GetID(),
                    '#LOGIN#' => $USER->GetLogin(),
                    '#NAME#' => $USER->GetFirstName(),
                    '#NAME_FORM#' => $arFields["AUTHOR"]
                ]);
            } else {
                // Если не авторизован
                $arFields["AUTHOR"] = GetMessage("EX2_51_NOT_AUTH", [
                    '#NAME_FORM#' => $arFields["AUTHOR"]
                ]);
            }
            // Запись в журнал событий
            CEventLog::Add([
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID" => "LETTER_CHANGED",
                "MODULE_ID" => "main",
                "DESCRIPTION" => GetMessage("EX2_51_INFO_CHANGED", [
                    '#NAME_FORM#' => $arFields["AUTHOR"]
                ]),
            ]);
        }
    }
}