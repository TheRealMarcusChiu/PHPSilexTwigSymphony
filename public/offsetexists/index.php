<?php

require_once __DIR__ . '/../../vendor/autoload.php';

date_default_timezone_set('UTC');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app['debug'] = true;

$app['hello'] = null;
if ($app->offsetExists("hello")) {
    echo '$app->offsetExists("hello") = ' . 'true';
} else {
    echo '$app->offsetExists("hello") = ' . 'false';
}


$app->get('/', function (Request $request) use ($app) {
    return "";
});

$app->run();

?>