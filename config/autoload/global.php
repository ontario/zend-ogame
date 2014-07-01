<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'service_manager' => array(
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service'
        ),
        'factories' => array(
            'doctrine.cache.app_memcache' => function ($sm) {
                    $cache = new \Doctrine\Common\Cache\MemcacheCache();
                    $memcache = new \Memcache();
                    $memcache->connect('localhost', 11211);
                    $cache->setMemcache($memcache);
                    return $cache;
                },
        ),
    ),
    'doctrine' => array (
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache'    => 'app_memcache',
                'query_cache'       => 'app_memcache',
                'result_cache'      => 'app_memcache',
            ),
        ),
    ),	
);
