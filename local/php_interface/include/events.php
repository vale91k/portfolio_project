<?php

use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\AdminMenuEvents;

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["App\EventHandlers\AdminMenuEvents", "checkOnDeactivationElement"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);








