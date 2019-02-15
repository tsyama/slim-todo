<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Views\Blade;
use \Cake\ORM\Locator\TableLocator;

require_once 'vendor/autoload.php';
require_once 'database.php';
$config = require_once 'config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = function ($c) {
    return new Blade(
        $c['settings']['renderer']['blade_template_path'],
        $c['settings']['renderer']['blade_cache_path']
    );
};

$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('my_logger');
    $fileHandler = new \Monolog\Handler\StreamHandler('logs/app.log');
    $logger->pushHandler($fileHandler);
    return $logger;
};

$container['locator'] = function ($c) {
    $locator = new TableLocator();
    return $locator;
};

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $this->logger->addInfo("Hello, {$name}");

    $ticketTable = $this->locator->get('Tickets');
    $ticket = $ticketTable->newEntity(['title' => $name]);
    $ticketTable->save($ticket);

    $data = [
        'name' => $name,
    ];
    return $this->view->render($response, 'hello', $data);
});

$app->run();