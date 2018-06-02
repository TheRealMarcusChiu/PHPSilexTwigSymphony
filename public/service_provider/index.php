<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/HelloServiceProvider.php';

date_default_timezone_set('UTC');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app['debug'] = true;

$app->register(new HelloServiceProvider(), array(
    'hello.default_name' => 'default passed as parameter'
));

//if ($app->offsetExists("hello.default_name")) {
//    echo $app['hello.default_name'];
//}

$app->get('/', function (Request $request) use ($app) {
    $name = $request->get('name');

    return $app['hello']($name);
});


$app->run();

?>