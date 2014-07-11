<?php

$loader = require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/TridentKernel.php';

$request = Trident\Component\HttpFoundation\Request::createFromGlobals();
$kernel  = new TridentKernel('prod', TridentKernel::DEBUG_DISABLED);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
