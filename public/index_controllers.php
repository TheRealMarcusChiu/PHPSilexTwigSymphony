<?php

use Silex\Application;
use app\controller\user\UserController;

$app = new Application();
$app['debug'] = true;

////////////////
// Controller //
////////////////
$app->get('/', function(){
    return '<a href="/user">user controller</a>';
});

$app->mount("/user", new UserController());

$app->run();