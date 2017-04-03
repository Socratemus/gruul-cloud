<?php

namespace Folders;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            
            'folders_route' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/folders[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            
        ],
    ],
    
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Factory\Controller\IndexControllerFactory::class,
        ],
    ],
    
    'doctrine' => [
        'driver' => array(
            'folders_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity',
                    
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Folders\Entity' => 'folders_entities'
                )
            )
        )
    ]
];
