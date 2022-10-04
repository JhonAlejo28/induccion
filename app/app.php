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
    "getDogs"
]);

$app->get('/pets/{$id}', [
    new DogsController(),
    "getDog"
]);

$app->post('/pets/crear', [
    new DogsController(),
    "createDogs"
]);

$app->put('/pets/actualizar/{$id}', [
    new DogsController(),
    "updateDogs"
]);

$app->delete('/pets/eliminar/{$id}', [
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
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'Estás donde no es';
});
