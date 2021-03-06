<?php
return array(
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
                'cache' => 'app_memcache',
                'paths' => array(__DIR__ . '/../src/Auth/Model/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Auth\Model\Entity' => 'zfcuser_entity'
                ),
            ),
        ),
        'fixture' => array(
            'Auth_Fixture' => __DIR__ . '/../src/Auth/Model/Fixture',
        ),
    ),
    'default_user_role_name' => 'user', // 1 - guest, 2 - user, 3 - admin
    'zfcuser' => array(
        'user_entity_class'       => 'Auth\Model\Entity\User',
        'enable_default_entities' => false,
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
