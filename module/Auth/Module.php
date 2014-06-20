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

    public function onBootstrap(EventInterface $mvcEvent)
    {
        $t = $mvcEvent->getTarget();

        $t->getEventManager()->attach(
            $t->getServiceManager()->get('Auth\View\Strategy\SmartRedirectStrategy')
        );

        $sm = $mvcEvent->getApplication()->getServiceManager();

        $zfcServiceEvents = $sm->get('zfcuser_user_service')->getEventManager();

        $zfcServiceEvents->attach('register',
            function($e) use($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_default');
                $config = $sm->get('config');

                $user = $e->getParam('user');

                if ( isset($config['default_user_role_id']) ) {
                    $defaultUserRole = $em->getRepository('Auth\Model\Entity\HierarchicalRole')
                        ->find($config['default_user_role_id']);
                    $user->addRole($defaultUserRole);
                }
            }
        );
    }
}
