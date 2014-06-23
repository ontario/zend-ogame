<?php
return array(
    'default_user_role' => 'user',
    'controllers'     => array(
        'invokables' => array(
            'Auth\Controller\AdminUser'   => 'Auth\Controller\AdminUserController',
        ),
    ),
    'router' => array (
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'user' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/user[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Auth\Controller\AdminUser',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            )
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'zfcuser_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Auth/Model/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Auth\Model\Entity' => 'zfcuser_entity'
                ),
            ),
        ),
    ),

    // ZfcUser specific config
    'zfcuser' => array(
        'user_entity_class'       => 'Auth\Model\Entity\User',
        'enable_default_entities' => false,
    ),

    'zfc_rbac' => [
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'zfcuser/login'    => ['guest'],
                'zfcuser/register' => ['guest'], // required if registration is enabled
                'zfcuser*'         => ['user'],  // includes logout, changepassword and changeemail
            ]
        ],
        'redirect_strategy' => [
            'redirect_when_connected'        => false,
            'redirect_to_route_connected'    => 'zfcuser',
            'redirect_to_route_disconnected' => 'zfcuser/login',
            'append_previous_uri'            => true,
            'previous_uri_query_key'         => 'redirectTo'
        ],
    ],
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);