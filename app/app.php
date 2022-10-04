<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/*Activación de cores sin login*/

$app->before(function() use ($app) {
     $origin = $app->request->getHeader("ORIGIN") ? $app->request->getHeader("ORIGIN") : '*';
    
     $app->response->setHeader("Access-Control-Allow-Origin", $origin)
          ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
           ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
          ->setHeader("Access-Control-Allow-Credentials", true);
     });
    
     $app->options('/{catch:(.*)}', function() use ($app) { 
         $app->response->setStatusCode(200, "OK")->send();
 });


/*  $app->before([
    new AclController(),
    'init'
]); */


/**
 * Add your routes here
 */
$app->get('/', function () {
    echo 'Estás en el indice';
});

/* $app->get('/prueba', [
    new PruebaController(),
    "index"
]);
 */
$app->get('/pets', [
    new DogsController(),
    "get"
]);

$app->get('/pets/{$id}', [
    new DogsController(),
    "getDog"
]);

$app->get('/pets?name={$name}', [
    new DogsController(),
    "getDogName"
]);

$app->post('/pets', [
    new DogsController(),
    "createDogs"
]);

$app->put('/pets/{$id}', [
    new DogsController(),
    "updateDogs"
]);

$app->delete('/pets/{$id}', [
    new DogsController(),
    "deleteDogs"
]);


/*
**Options Method
*/ 

/* $app->options('/{catch:(.*)}', [
    new CORSController(),
    'init'
]);  */

/**
 * Not found handler
 */
$app->notFound([
    new ErrorhandlerController(),
    'notFound'
]
);
