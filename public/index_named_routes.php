<?php

use Silex\Application;

$app = new Application();
$app['debug'] = true;

$app->get('/', function(){
    return '<a href="/named_routes">Named Routes</a>';
});

//////////////////
// Named Routes //
//////////////////

$app->get("/named_routes", function(Silex\Application $app){
    return "named routes";
})->bind('named_routes');


$app->run();

?>