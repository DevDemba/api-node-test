<?php

require __DIR__ . '/app_const.php';

use E_motion\Component\Routing\RouteLoader;

(new RouteLoader)->init();

session_save_path(SESSION_PATH);
session_start();
session_regenerate_id();
