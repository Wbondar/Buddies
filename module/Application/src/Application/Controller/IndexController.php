<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController 
extends AbstractActionController
{
    public function indexAction()
    {
        $this->getResponse( )->setStatusCode(303);
        return $this
            ->redirect( )
            ->toRoute
            (
                  'application'
                , array
                (
                      'controller' => 'person'
                    , 'action'     => 'myself'
                )
            );
    }
}
