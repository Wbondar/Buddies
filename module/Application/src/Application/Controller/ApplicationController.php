<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class ApplicationController 
extends AbstractActionController
{
    protected function redirectToPersonalProfile( )
    {
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

    protected function redirectToAuthentication( )
    {
        return $this
            ->redirect( )
            ->toRoute
            (
                  'application'
                , array
                (
                      'controller' => 'account'
                    , 'action'     => 'authenticate'
                )
            );
    }
}
