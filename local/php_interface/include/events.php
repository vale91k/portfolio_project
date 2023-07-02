<?php

use App\EventHandlers\TestEventHandler;

AddEventHandler("main", "OnBeforeEventAdd", ["App\EventHandlers\TestEventHandler", "feedbackService"]);
