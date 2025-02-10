<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Controllers/VehicleController.php';
/*require __DIR__ . '/../app/Middleware/AuthMiddleware.php';*/

use Slim\Factory\AppFactory;
use Slim\Psr7\Response;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Rota para validar veículos
$app->get('/validate', function ($request, $response, $args){
    $controller = new VehicleController();
    return $controller->validate($request, $response, $args);
})/*->add(new AuthMiddleware())*/;

// Executa a aplicação
$app->run();
?>