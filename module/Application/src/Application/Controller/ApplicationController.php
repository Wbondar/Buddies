<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Person;

abstract class ApplicationController 
extends AbstractActionController
{
    protected function isMyself (Person $person)
    {
        if ($this->identity( ) == null)
        {
            return false;
        }
        if ($myself = $this->identity( )->getPerson( ))
        {
            if ($myself == null)
            {
                return false;
            }
            return $person->getId( ) == $myself->getId( );
        }
    }

    protected function isAuthenticated ( )
    {
        return $this->identity( ) != null;
    }

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
