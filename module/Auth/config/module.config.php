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
);