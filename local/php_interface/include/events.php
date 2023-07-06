<?php

use App\EventHandlers\FeedbackEventHandler;

AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\FeedbackEventHandler", "feedbackService"]);
