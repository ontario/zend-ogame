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
    }
}
