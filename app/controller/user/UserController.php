<?php

require_once __DIR__ . '/../../../log/log.php';

class UserController{

    public function index(){
        return "index";
    }

    public function edit($id){
        Log::logit("user controller edit: $id");
    }

    public function show($id){
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