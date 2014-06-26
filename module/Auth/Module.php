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
                'Auth\Model\Service\AuthUserService'       => 'Auth\Model\Service\AuthUserService',
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $mvcEvent)
    {
        $target = $mvcEvent->getTarget();

        $sm = $mvcEvent->getApplication()->getServiceManager();
        $target->getEventManager()->attach(
            $sm->get('Auth\View\Strategy\SmartRedirectStrategy')
        );

        $zfcServiceEvents = $sm->get('zfcuser_user_service')->getEventManager();
        $zfcServiceEvents->attach('register', function ($e) use ($sm) {
            $user = $e->getParam('user');
            $em = $sm->get('doctrine.entitymanager.orm_default');
            $config = $sm->get('config');
            if (isset($config['default_user_role_id'])) {
                $defaultUserRole = $em->getRepository('Auth\Model\Entity\HierarchicalRole')->
                    findBy(array('name'=>$config['default_user_role_name']))
                    ->first();
                $user->addRole($defaultUserRole);
            } else {
                throw new \Exception('Config value "default_user_role_name" is missing.');
            }
        });
    }
}
