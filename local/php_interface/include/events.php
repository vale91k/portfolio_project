<?php

use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\ElementsIBlockEvents;

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["App\EventHandlers\ElementsIBlockEvents", "checkOnDeactivationElement"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);








