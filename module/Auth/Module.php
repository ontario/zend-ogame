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

        $zfcServiceEvents->attach('register', function($event) use($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_default');
                $config = $sm->get('config');

                $user = $event->getParam('user');

                if ( isset($config['default_user_role_id']) ) {
                    $defaultUserRole = $em->getRepository('Auth\Model\Entity\HierarchicalRole')
                        ->find($config['default_user_role_id']);
                    $user->addRole($defaultUserRole);
                } else {
                    throw new \Exception ('Default user role id not set.');
                }
            }
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
