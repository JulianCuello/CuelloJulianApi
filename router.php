
<?php
require_once 'libs/router.php';
require_once 'app/controllers/toy.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';

$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());


#                 endpoint                      verbo           controller              metodo
$router->addRoute('toys',            'GET',     'ProductoController',   'getToys');
$router->addRoute('toys/:id',            'GET',     'ProductoController',   'getToy');
$router->addRoute('toys/:id',            'DELETE',  'ProductoController',   'deleteToy');
$router->addRoute('toys',                'POST',    'ProductoController',   'createToy');
$router->addRoute('toys/:id',            'PUT',     'ProductoController',    'updateToy');

$router->addRoute('usuarios/token',            'GET',     'UserApiController',   'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
