<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 6/25/14
 * Time: 11:23 PM
 */

namespace Auth\Model\Fixture;


use Auth\Model\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthUserFixture extends AbstractFixture implements DependentFixtureInterface {
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
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
        $user = new User();
        $user->setId(1);
        $user->setEmail('admin@example.com');
        $user->setDisplayName('Default admin');
        $user->setPassword('superadmin');
        $user->setUsername('Admin');

        $manager->persist($user);

        $manager->flush();
    }

} 