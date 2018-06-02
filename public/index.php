<?php

// import autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// must set default timezone to remove errors
date_default_timezone_set('UTC');

//include 'index_basic.php';
//include 'index_app_before_after.php';
//include 'index_routing_params.php';
//include 'index_named_routes.php';
include 'index_app_register.php';
//include 'index_controllers.php';
//include 'index_request.php';

?>