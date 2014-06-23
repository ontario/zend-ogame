<?php
namespace Auth;

use Zend\EventManager\EventInterface;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Auth\View\Strategy\SmartRedirectStrategy' => 'Auth\Factory\SmartRedirectStrategyFactory',
            ]
        ];
    }

    public function onBootstrap(EventInterface $e)
    {
        $t = $e->getTarget();

        $t->getEventManager()->attach(
            $t->getServiceManager()->get('Auth\View\Strategy\SmartRedirectStrategy')
        );

        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();
        $zfcServiceEvents->attach('register', function($e) use($e) {
            $user = $e->getParam('user');
            $em = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
            $config = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['default_user_role'])) {
                $defaultUserRole = $em->getRepository('Auth\Model\Entity\HierarchicalRole')->findBy($config['default_user_role']);
                $user->addRole($defaultUserRole);
            }
        });
    }
}
