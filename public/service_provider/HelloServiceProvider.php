<?php

use Silex\ServiceProviderInterface;
use Silex\Application;

class HelloServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['hello.default_name'] = "default from within register method";

        $app['hello'] = $app->protect(function ($name) use ($app) {

            $default = $app['hello.default_name'] ? $app['hello.default_name'] : '';
            $name = $name ?: $default;

            return 'parameter: '.$app->escape($name);
        });
    }

    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}