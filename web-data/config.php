<?php

return [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'db' => [
        'host' => 'db',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'slim_todo',
    ],
    'renderer' => [
        'blade_template_path' => __DIR__ . '/views',
        'blade_cache_path' => __DIR__ . '/cache',
    ],
];