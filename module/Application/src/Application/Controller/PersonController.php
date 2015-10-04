<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Person;
use Application\Service\AccountService;
use Application\Service\PersonService;
use Application\Form\CredentialsUpdateForm;
use Application\Form\PersonCreateForm;
use Application\Form\EMailAddressCreateForm;
use Application\Form\PhoneNumberCreateForm;
use Application\Form\PersonRetrieveByCredentialsForm;

/**
 * Controller, responsible for retrieving data about persons from the system.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class PersonController 
extends ApplicationController
{
    private $accountService;
	private $personService;

  	public function __construct (AccountService $accountService, PersonService $personService)
  	{
        $this->accountService = $accountService;
  		$this->personService = $personService;
  	}

	/**
	 * Renders HTML page on GET
	 * which describes person.
	 */
  	
    public function retrieveAction ( )
    {
        $request = $this->getRequest( );
        if ($request->isGet( ))
        {
            $id = $this->params( )->fromRoute("id");
            if ($id)
            {
                $person = $this->personService->retrieve($id);
                if ($person != null)
                {
                    if ($this->isMyself($person))
                    {
                        return $this->redirectToPersonalProfile( );
                    }
                    return array('person' => $person);   
                }
                $this->getResponse( )->setStatusCode(404);
                return array ('message' => 'Could not find person.');
            }
        }
        $this->getResponse( )->setStatusCode(405);
        return array('message' => 'Method not allowed.');
    }

    public function findAction ( )
    {
        $request = $this->getRequest( );
        $form = new PersonRetrieveByCredentialsForm ( );
        if ($request->isGet( ))
        {
            $form->setData($request->getQuery( ));
            if ($form->isValid( ))
            {
                $persons = $this->personService->retrieveWithCredentialsLike($form->getData( )['trait']);
            } else {
                $this->layout( )->messages = $form->getMessages( );
            }
        } else {
            $this->getResponse( )->setStatusCode(405);
        }
        return array ('findPersonForm' => $form, 'persons' => $persons);
    }
    
    /**
     * Renders HTML page describing personal profile for logged in user.
     */

    public function myselfAction ( )
    {
        if ($this->accountService->isAuthenticated( ))
        {
            $account = $this->accountService->retrieve( );
            $myself = $account->getPerson( );
            return array 
            (
                'account'                => $account
              , 'myself'                 => $myself
              , 'emailAddressCreateForm' => new EMailAddressCreateForm ( )
              , 'phoneNumberCreateForm'  => new PhoneNumberCreateForm ( )
              , 'credentialsUpdateForm'  => new CredentialsUpdateForm ( )
              , 'findPersonForm'         => new PersonRetrieveByCredentialsForm ( )
            );
        }
        $this->getResponse( )->setStatusCode(400);
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
