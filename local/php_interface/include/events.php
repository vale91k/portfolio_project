<?php

use App\EventHandlers\AdminMenuEvents;

AddEventHandler("main", "OnBuildGlobalMenu", ["App\EventHandlers\AdminMenuEvents", "SimplificationAdminMenu"]);

