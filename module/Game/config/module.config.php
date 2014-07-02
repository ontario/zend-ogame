<?php
namespace Game;

return array(
    'controllers'     => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\Overview'   => __NAMESPACE__ . '\Controller\OverviewController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'game' => array(
                'type'          => 'literal',
                'options'       => array(
                    'route'    => '/game',
                    'defaults' => array(
                        'controller' => __NAMESPACE__ . '\Controller\Overview',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'home'    => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/overview',
                            'defaults' => array(
                                'controller' => __NAMESPACE__ . '\Controller\Overview',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                )
            ),
        ),
    ),
    'zfc_rbac' => [
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'game*'    => ['user'],
            ]
        ],
    ],
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ .'_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'app_memcache',
                'paths' => array(__DIR__ . '/../src/'. __NAMESPACE__ .'/Model/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ .'\Model\Entity' => __NAMESPACE__ .'_entity'
                ),
            ),
        ),
        'fixture' => array(
            __NAMESPACE__ .'_Fixture' => __DIR__ . '/../src/'. __NAMESPACE__ .'/Model/Fixture',
        ),
    ),

);
