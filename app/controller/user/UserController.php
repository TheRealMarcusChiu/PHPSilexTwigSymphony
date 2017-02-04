<?php

namespace app\controller\user;

use app\logger\Log;
use Silex\Application;
use Silex\ControllerProviderInterface;

class UserController implements ControllerProviderInterface {

    public function connect(Application $app)
    {
        $users = $app["controllers_factory"];

        $users->get('/', [$this, 'index']);

        $users->post("/", [$this, 'store']);

        $users->get("/{id}", [$this, 'show']);

        $users->get("/edit/{id}", [$this, 'edit']);

        $users->put("/{id}", [$this, 'update']);

        $users->delete("/{id}", [$this, 'destroy']);

        ///////////////////////////
        // Before After Response //
        ///////////////////////////

        // before after - must return null or response
        $users->get("/extra/{user}", function($user){
            return "User {$user}";
        })->before(function($request, $app){
            //return new Symfony\Component\HttpFoundation\Response("before");
        })->after(function($request, $response){
            //return new Symfony\Component\HttpFoundation\Response("after");
        });

        return $users;
    }

    public function index(){
        Log::logit("user controller index");

        return '<a href="/user">itself</a>
                <div/>
                <a href="/user/1">/user/1</a>';
    }

    public function edit($id){
        Log::logit("user controller edit: $id");
    }

    public function show($id){
        Log::logit("user controller show");
        return "show $id";
    }

    public function store(){
        // create a new user, using POST method
        Log::logit("user controller store");
    }

    public function update($id){
        // update the user #id, using PUT method
        Log::logit("user controller update: $id");
    }

    public function destroy($id){
        // delete the user #id, using DELETE method
        Log::logit("user controller destroy: $id");
    }
}