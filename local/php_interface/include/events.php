<?php

use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\AdminMenuEvents;

AddEventHandler("main", "OnBuildGlobalMenu", ["App\EventHandlers\AdminMenuEvents", "SimplificationAdminMenu"]);
AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);





