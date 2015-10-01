<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Person;
use Application\Form\CredentialsUpdateForm;
use Application\Form\PersonCreateForm;
use Application\Form\EMailAddressCreateForm;
use Application\Form\PhoneNumberCreateForm;

class PersonController 
extends AbstractActionController
{
    private $accountService;
	private $personService;

  	public function __construct ($accountService, $personService)
  	{
        $this->accountService = $accountService;
  		$this->personService = $personService;
  	}


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
                    return array('person' => $person);   
                }
                $this->getResponse( )->setStatusCode(404);
                return array ('message' => 'Could not find person.');
            } else {
                $persons = $this->personService->retrieveWithCredentialsLike($this->params( )->fromQuery("trait"));
                return array ('persons' => $persons);
            }
        }
        $this->getResponse( )->setStatusCode(405);
        return array('message' => 'Method not allowed.');
    }

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
