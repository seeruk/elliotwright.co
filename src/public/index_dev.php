<?php

$loader = require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/TridentKernel.php';

$request = Trident\Component\HttpFoundation\Request::createFromGlobals();
$kernel  = new TridentKernel('dev', TridentKernel::DEBUG_DISABLED);
$kernel  = new TridentKernel('dev', TridentKernel::DEBUG_ENABLED);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
