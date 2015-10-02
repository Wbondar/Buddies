<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Person;

/**
 * 
 * Abstract class, that holds utility methods for it's subclasses,
 * such as checking if the user is logged in,
 * delegation of redirection,
 * etc.
 * @author wbondarenko@programmer.net
 *
 */

abstract class ApplicationController 
extends AbstractActionController
{
	/**
	 * Checks if provided person is the same person who is logged in.
	 * Contains somehow tricky logic, for identity, stored in a session
	 * is not an instance of Person.
	 * See documentation for \Application\Entity\Account class for details.
	 * @param Person $person person to check if logged in
	 * @return boolean true then and only then $person has the same ID as logged in person
	 */
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
        return false;
    }
    
    /**
     * Checks if 
     * @return boolean true then and only then identity, stored in a session, is not null.
     */

    protected function isAuthenticated ( )
    {
        return $this->identity( ) != null;
    }
    
    /**
     * Redirects to personal profile.
     */

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
    
    /**
     * Redirects to authentication.
     */

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
