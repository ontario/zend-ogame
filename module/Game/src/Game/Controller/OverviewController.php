<?php
/**
 * Created by PhpStorm.
 * User: yhimenko
 * Date: 02.07.14
 * Time: 18:51
 * @author Yuriy. V. Yukhimenko
 */

namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OverviewController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
}
