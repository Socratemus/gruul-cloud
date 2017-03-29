<?php

namespace WordEngine\Factory\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use WordEngine\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface {
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $controller = new IndexController();
        $controller->setEntityManager($entityManager);
        return $controller;
    }
}