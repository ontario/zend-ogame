<?php
namespace Game;

return array(
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
