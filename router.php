
<?php
require_once 'libs/router.php';
require_once 'app/controllers/toy.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';

$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());


#                 endpoint                      verbo           controller              metodo
$router->addRoute('toys',            'GET',     'ToyController',   'getToys');
$router->addRoute('toy/:id',            'GET',     'ToyController',   'getToy');
$router->addRoute('toy/:id',            'DELETE',  'ToyController',   'deleteToy');
$router->addRoute('toy',                'POST',    'ToyController',   'createToy');
$router->addRoute('toy/:id',            'PUT',     'ToyController',    'updateToy');

$router->addRoute('usuarios/token',            'GET',     'UserApiController',   'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
