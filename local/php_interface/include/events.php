<?php

use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\PageNotFoundEventHandler;
use App\EventHandlers\ElementsIBlockEvents;
use App\EventHandlers\AdminMenuEventHandler;

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["App\EventHandlers\ElementsIBlockEvents", "checkOnDeactivationElement"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);
AddEventHandler("main", "OnEpilog", ["App\EventHandlers\PageNotFoundEventHandler", "entryEventLogAtPage404"]);
AddEventHandler("main", "OnBuildGlobalMenu", ["App\EventHandlers\AdminMenuEventHandler", "simplificationAdminMenu"]);










