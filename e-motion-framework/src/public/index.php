<?php

require __DIR__ . '/../_core_/boot.php';
require __DIR__ . '/../web_src/app_boot.php';

use App\AppKernel;
use E_motion\Component\HttpIce\Request;

$kernel = new AppKernel();
$request = new Request();
$response = $kernel->handle($request);
$kernel->terminate($request,$response);
