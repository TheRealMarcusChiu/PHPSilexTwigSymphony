<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

//////////////////////////////
// Create Silex\Application //
//////////////////////////////

$app = new Application();

/////////////////////
// Debug ON or OFF //
/////////////////////

$app['debug'] = true;


// Silex can handle GET, POST, PUT, DELETE or we can use the 'match' method
$app->get('/', function(){
    return '<a href="/symfony">symfony</a>
            <div/>
            <a href="/string">string</a>';
});

// The handle function must return either a string or a Symfony\Component\HttpFoundation\Response instance
$app->get('/string', function(){
    // return string example
    return "String Response";
});

$app->get('/symfony', function(){
    // return Response example
    return new Response('Symfony Response');
});


$app->run();

?>