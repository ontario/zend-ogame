<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 6/20/14
 * Time: 12:54 AM
 */

namespace Auth\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Auth\View\Strategy\SmartRedirectStrategy;

class SmartRedirectStrategyFactory implements FactoryInterface {
    /**
     * gets SmartRedirectStrategy
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return SmartRedirectStrategy
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SmartRedirectStrategy($serviceLocator->get('zfcuser_auth_service'));
    }
} 