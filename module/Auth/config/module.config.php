<?php
return array(

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
                'home'             => ['guest'],
                '*'                => ['admin']
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
);