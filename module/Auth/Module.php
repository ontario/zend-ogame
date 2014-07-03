<?php
namespace Auth;

use Zend\EventManager\EventInterface;

class Module {
	public function getConfig() {
		return include __DIR__ .'/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces'                    => array(
					__NAMESPACE__                  => __DIR__ .'/src/'.__NAMESPACE__,
				),
			),
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getServiceConfig() {
		return [
			'factories'                                 => [
				'Auth\View\Strategy\SmartRedirectStrategy' => 'Auth\Factory\SmartRedirectStrategyFactory',
				'Auth\Model\Service\AuthUserService'       => 'Auth\Model\Service\AuthUserService',
			]
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function onBootstrap(EventInterface $mvcEvent) {
		$target = $mvcEvent->getTarget();

		$sm = $mvcEvent->getApplication()->getServiceManager();
		$target->getEventManager()->attach(
			$sm->get(__NAMESPACE__ .'\View\Strategy\SmartRedirectStrategy')
		);

		$zfcServiceEvents = $sm->get('zfcuser_user_service')->getEventManager();
		$zfcServiceEvents->attach('register', function ($e) use ($sm) {
				/** @var \Auth\Model\Entity\User $user */
				$user = $e->getParam('user');
				/** @var \Doctrine\ORM\EntityManager $em */
				$em = $sm->get('doctrine.entitymanager.orm_default');
				$config = $sm->get('config');
				if (isset($config['default_user_role_name'])) {
					/** @var \Auth\Model\Entity\HierarchicalRole $defaultUserRole */
					$defaultUserRole = $em->getRepository(__NAMESPACE__ .'\Model\Entity\HierarchicalRole')->
					findOneBy(array('name' => $config['default_user_role_name']));
					$user->addRole($defaultUserRole);
				} else {
					throw new \Exception('Config value "default_user_role_name" is missing.');
				}
			}
		);
	}
}
