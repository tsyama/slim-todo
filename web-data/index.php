<?php
use Slim\Views\Blade;
use Cake\ORM\Locator\TableLocator;
use App\Controllers\HelloController;

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

$app->get('/hello/{name}', HelloController::class . ':index');

$app->run();