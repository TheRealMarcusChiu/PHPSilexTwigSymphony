<?php

// import autoload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/controller/user/User.php';
require_once __DIR__ . '/../app/controller/user/UserController.php';

use Silex\Application;

// must set default timezone to remove errors
date_default_timezone_set('UTC');

//////////////////////////////
// Create Silex\Application //
//////////////////////////////
// app container instance
$app = new Application();

/////////////////////
// Debug ON or OFF //
/////////////////////
$app['debug'] = true;

//
$app->get('/', function(){
    return '<a href="/symfony">symfony</a>
            <div/>
            <a href="/string">string</a>';
});

// Silex can handle GET, POST, PUT, DELETE or we can use the 'match' method
// The handle function must return either a string or a Symfony\Component\HttpFoundation\Response instance
$app->get('/string', function(){
    return "String Response";
});

$app->get('/symfony', function(){
    return new Symfony\Component\HttpFoundation\Response('Symfony Response');
});

////////////////////////
// Routing Parameters //
////////////////////////
$app->get('/hello/{name}', function($name) {
    return "Hello - {$name}";
});

///////////////////////////
// Before After Response //
///////////////////////////
// before after - must return null or response
$app->get("/user/{user}", function($user){
    // return the user profile
    return "User {$user}";
})->before(function($request, $app){
    // redirect if the user is not logged in
    //return new Symfony\Component\HttpFoundation\Response("before");
})->after(function($request, $response){
    // log request events
    //return new Symfony\Component\HttpFoundation\Response("after");
});

//////////////////
// Named Routes //
//////////////////
$app->get("/named_routes", function(Silex\Application $app){
    return "named routes";
})->bind('named_routes');

////////////////
// Controller //
////////////////
$app->get("/controller", "app\\controller\\user\\UserController::index");

//////////////////////////
// Grouping Controllers //
//////////////////////////
$app->mount("/users", new User());

$app->run();

?>