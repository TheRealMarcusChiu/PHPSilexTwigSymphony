<?php

use Silex\Application;
use A\ContentNegotiationServiceProvider;

$app = new Application();
$app['debug'] = true;

// register all these services so we can use them
$provider = new ContentNegotiationServiceProvider();
$app->register($provider, array(
    "conneg.responseFormats" => array("json"),
    "conneg.requestFormats" => array("json"),
    "conneg.defaultFormat" => "json"
));

$app->get('/', function(){
    return '<a href="/">to no where</a>';
});

$app->run();

?>
