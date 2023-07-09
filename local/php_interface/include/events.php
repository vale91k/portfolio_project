<?php
use App\EventHandlers\FeedbackEventHandler;
use App\EventHandlers\EventLogHandler;

AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);
AddEventHandler("main", "OnEpilog", ["App\EventHandlers\EventLogHandler", "entryEventLogAtPage404"]);





