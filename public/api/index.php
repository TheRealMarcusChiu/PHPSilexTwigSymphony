<?php

require_once __DIR__ . '/../../vendor/autoload.php';

date_default_timezone_set('UTC');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/*
Client Request

POST /blog/posts
Accept: application/json
Content-Type: application/json
Content-Length: 57

{"title":"Hello World!","body":"This is my first post!"}
*/

/*
Server Response

HTTP/1.1 201 Created
Content-Type: application/json
Content-Length: 65
Connection: close

{"id":"1","title":"Hello World!","body":"This is my first post!"}
*/

$app = new Application();
$app['debug'] = true;

// need this to populate the request.request
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->post('/', function (Request $request) use ($app) {
    $post = array(
        'title' => $request->request->get('title'),
        'body'  => $request->request->get('body'),
    );

    $post['id'] = createPost($post);

    return $app->json($post, 201);
});

$app->run();


function createPost($post) {
    // insert into database
    return 1;
}

?>