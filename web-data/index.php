<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Views\Blade;

require_once 'vendor/autoload.php';
$config = require_once 'config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = function ($c) {
    return new Blade(
        $c['settings']['renderer']['blade_template_path'],
        $c['settings']['renderer']['blade_cache_path']
    );
};

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $fileHandler = new \Monolog\Handler\StreamHandler('logs/app.log');
    $logger->pushHandler($fileHandler);
    return $logger;
};

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $this->logger->addInfo("Hello, {$name}");
    $data = [
        'name' => $name,
    ];
    return $this->view->render($response, 'hello', $data);
});

$app->run();