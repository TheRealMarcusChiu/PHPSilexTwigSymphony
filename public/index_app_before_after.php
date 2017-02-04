<?php

use Silex\Application;

$app = new Application();
$app['debug'] = true;

////////////////
// app before //
////////////////

function before_priority_default_zero() {
    echo "before priority default 0<div/>";
}
function before_priority_EARLY_EVENT() {
    echo "before priority Application::EARLY_EVENT<div/>";
}
function before_priority_LATE_EVENT() {
    echo "before priority Application::LATE_EVENT<div/>";
}

// second parameter - higher number = higher priority
$app->before("before_priority_default_zero");
$app->before("before_priority_EARLY_EVENT", Application::EARLY_EVENT);
$app->before("before_priority_LATE_EVENT", Application::LATE_EVENT);


///////////////
// app after //
///////////////

function after_priority_default_zero() {
    echo "after priority default 0<div/>";
}
function after_priority_EARLY_EVENT() {
    echo "after priority Application::EARLY_EVENT<div/>";
}
function after_priority_LATE_EVENT() {
    echo "after priority Application::LATE_EVENT<div/>";
}

// second parameter - higher number = higher priority
$app->after("after_priority_default_zero");
$app->after("after_priority_EARLY_EVENT", Application::EARLY_EVENT);
$app->after("after_priority_LATE_EVENT", Application::LATE_EVENT);

$app->get('/', function(){
    return 'index app before after example';
});

$app->run();

?>

