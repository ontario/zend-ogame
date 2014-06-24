<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 6/23/14
 * Time: 9:56 PM
 */

namespace Auth\Model\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Model\Entity\User;

class AuthUserService implements FactoryInterface {

    /**
     * @var User
     */
    protected $table;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $sm
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $sm)
    {
        $om = $sm->get('Doctrine\ORM\EntityManager');
        $this->table = $om->getRepository('\Auth\Model\Entity\User');
        return $this;
    }

    /**
     * @return array
     */
    public function getAll() {
        $users = $this->table->findAll();
        $users_array = array();
        foreach ($users as $user) {
            $users_array[] = $users->getArrayCopy();
        }
        return $users_array;
    }

} 