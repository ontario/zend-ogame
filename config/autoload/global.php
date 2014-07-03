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
	'service_manager'                             => array(
		'aliases'                                    => array(
			'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service',
		),
		'factories'                    => array(
			'doctrine.cache.app_memcache' => function ($sm) {
				$cache = new \Doctrine\Common\Cache\MemcacheCache();
				$memcache = new \Memcache();
				$memcache->connect('localhost', 11211);
				$cache->setMemcache($memcache);
				return $cache;
			},
		),
	),
	'doctrine'       => array(
		'connection'    => array(
			'orm_default'  => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params'      => array(
					'host'       => 'localhost',
					'port'       => '3306',
					'user'       => 'ogame',
					'password'   => 'ogame',
					'dbname'     => 'ogame',
				)
			)
		),
		'configuration'    => array(
			'orm_default'     => array(
				'metadata_cache' => 'app_memcache',
				'query_cache'    => 'app_memcache',
				'result_cache'   => 'app_memcache',
			),
		),
	),
	'zfc_rbac'                   => [
		'guards'                    => [
			'ZfcRbac\Guard\RouteGuard' => [
				'zfcuser/login'           => ['guest'],
				'zfcuser/register'        => ['guest'],
				'zfcuser*'                => ['user'],
			]
		],
		'redirect_strategy'               => [
			'redirect_when_connected'        => true,
			'redirect_to_route_connected'    => 'game',
			'redirect_to_route_disconnected' => 'zfcuser/login',
			'append_previous_uri'            => true,
			'previous_uri_query_key'         => 'redirect',
		],
	],
	'zfcuser'                            => array(
		'logout_redirect_route'             => 'home',
		'login_redirect_route'              => 'game',
		'use_redirect_parameter_if_present' => true,
		'login_after_registration'          => true,
		'enable_username'                   => true,
	),
);
