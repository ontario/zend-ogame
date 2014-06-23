<?php

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminUserController extends AbstractActionController
{

    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $users = $objectManager
            ->getRepository('\Auth\Model\Entity\User')
            ->findAll();

        $users_array = array();
        foreach ($users as $user) {
            $users_array[] = $user->getArrayCopy();
        }

        return new ViewModel(array('users' => $users_array));
    }

}
