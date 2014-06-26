<?php

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminUserController extends AbstractActionController
{

    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $users = $sm->get('\Auth\Model\Service\AuthUserService');
        $users_array = $users->getAll();
        return new ViewModel(array('users' => $users_array));
    }
}
