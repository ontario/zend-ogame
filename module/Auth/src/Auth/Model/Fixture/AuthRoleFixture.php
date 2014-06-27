<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 6/25/14
 * Time: 11:27 PM
 */

namespace Auth\Model\Fixture;


use Auth\Model\Entity\HierarchicalRole;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthRoleFixture extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $guestRole = new HierarchicalRole();
        $guestRole->setId(1);
        $guestRole->setName('guest');

        $userRole = new HierarchicalRole();
        $userRole->setId(2);
        $userRole->setName('user');
        $userRole->addChild($guestRole);

        $adminRole = new HierarchicalRole();
        $adminRole->setId(3);
        $adminRole->setName('admin');
        $adminRole->addChild($userRole);

        $manager->persist($guestRole);
        $manager->persist($userRole);
        $manager->persist($adminRole);

        $manager->flush();

        $this->addReference('guest-role', $guestRole);
        $this->addReference('user-role', $userRole);
        $this->addReference('admin-role', $adminRole);
    }
}
