<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 6/25/14
 * Time: 11:23 PM
 */

namespace Auth\Model\Fixture;

use Auth\Model\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthUserFixture extends AbstractFixture implements DependentFixtureInterface, ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return array('Auth\Model\Fixture\AuthRoleFixture');
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $options = $this->serviceLocator->get('zfcuser_module_options');

        $user = new User();
        $user->setId(1);
        $user->setEmail('admin@example.com');
        $user->setDisplayName('Admin example.com');

        $bcrypt = new Bcrypt;
        $bcrypt->setCost($options->getPasswordCost());

        $user->setPassword($bcrypt->create('adminadmin'));
        $user->setUsername('admin');
        $user->addRole($this->getReference('admin-role'));

        $manager->persist($user);

        $manager->flush();
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Set service locator
     * @return AuthUserFixture
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
