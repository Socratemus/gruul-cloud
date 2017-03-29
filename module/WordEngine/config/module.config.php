<?php
namespace WordEngine;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            
            'form' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/word-engine[/:action]',
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
            'word_engine_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Entity',
                    
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'WordEngine\Entity' => 'word_engine_entities'
                )
            )
        )
    ]
];
