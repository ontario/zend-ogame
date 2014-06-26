<?php
return array(
    'controllers'     => array(
        'invokables' => array(
            'Admin\Controller\Index'   => 'Admin\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'          => 'literal',
                'options'       => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'home'    => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Index',
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
                'admin*'    => ['admin'],
            ]
        ],
    ],
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
