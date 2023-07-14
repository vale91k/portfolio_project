<?php

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["App\EventHandlers\ElementsIBlockEvents", "checkOnDeactivationElement"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);
AddEventHandler("main", "OnEpilog", ["App\EventHandlers\PageNotFoundEventHandler", "entryEventLogAtPage404"]);
AddEventHandler("main", "OnBuildGlobalMenu", ["App\EventHandlers\AdminMenuEventHandler", "simplificationAdminMenu"]);
AddEventHandler("main", "OnBeforeProlog", ["App\EventHandlers\MetaChangerEventHandler", "productsTittleDescriptionChanger"]);










