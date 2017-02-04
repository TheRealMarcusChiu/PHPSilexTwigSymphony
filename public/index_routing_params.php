<?php

use Silex\Application;

$app = new Application();
$app['debug'] = true;

$app->get('/', function(){
    return '<a href="/hello/marcus">/hello/any_name_here</a>';
});

////////////////////////
// Routing Parameters //
////////////////////////

$app->get('/hello/{name}', function($name) {
    return "Hello - {$name}";
});

$app->run();

?>