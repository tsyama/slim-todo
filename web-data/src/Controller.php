<?php
namespace App;

use \Psr\Container\ContainerInterface;

abstract class Controller
{
    protected $view;
    protected $logger;
    protected $locator;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container['view'];
        $this->logger = $container['logger'];
        $this->locator = $container['locator'];
    }
}