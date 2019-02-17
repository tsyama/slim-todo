<?php
use Cake\Datasource\ConnectionManager;

ConnectionManager::setConfig('default', [
    'className' => 'Cake\Database\Connection',
    'driver' => 'Cake\Database\Driver\Mysql',
    'host' => 'db',
    'database' => 'slim_todo',
    'username' => 'root',
    'password' => 'root',
    'cacheMetadata' => false,
    'quoteIdentifiers' => false,
]);