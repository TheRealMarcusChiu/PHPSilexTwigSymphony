<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/UserController.php';

class User implements Silex\ControllerProviderInterface{

    public function connect(Silex\Application $app)
    {
        $users = $app["controllers_factory"];

        $users->get("/", "UserController::index");

        $users->post("/", "UserController::store");

        $users->get("/{id}", "UserController::show");

        $users->get("/edit/{id}", "UserController::edit");

        $users->put("/{id}", "UserController::update");

        $users->delete("/{id}", "UserController::destroy");

        return $users;
    }

}