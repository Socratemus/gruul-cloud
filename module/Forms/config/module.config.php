<?php

namespace Forms;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            
            'forms_route' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/forms[/:action[/:id]]',
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
            'forms_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity',
                    
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Forms\Entity' => 'forms_entities'
                )
            )
        )
    ]
];
