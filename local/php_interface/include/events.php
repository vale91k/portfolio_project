<?php

use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\AdminMenuEventHandler;
use App\EventHandlers\ElementsIBlockEvents;

AddEventHandler("main", "OnBuildGlobalMenu", ["App\EventHandlers\AdminMenuEventHandler", "simplificationAdminMenu"]);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["App\EventHandlers\ElementsIBlockEvents", "checkOnDeactivationElement"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);

