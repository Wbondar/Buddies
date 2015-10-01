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

    public function createAction ()
    {
         $form = new PersonCreateForm( );

         $request = $this->getRequest();
         if ($request->isPost()) {
            // TODO Implement input filter for form.
             //$form->setInputFilter(new PersonCreateInputFilter ( ));
             $form->setData($request->getPost());

             if ($form->isValid()) {
                $person = $this->personService->create($form->getData( ));
                return $this->redirect()->toRoute('application', array('controller' => 'person', 'action' => 'retrieve', 'id' => $person->getId( )));
             }
         }
         return array('form' => $form);
    }

    public function retrieveAction ( )
    {
        $request = $this->getRequest( );
        if ($request->isGet( ))
        {
            $id = $this->params( )->fromRoute("id");
            $person = $this->personService->retrieve($id);
            if ($person != null)
            {
                return array('person' => $person);   
            }
            $this->getResponse( )->setStatusCode(404);
            return array ('message' => 'Could not find person.');
        }
        $this->getResponse( )->setStatusCode(405);
        return array('message' => 'Method not allowed.');
    }

    /**
     * Since forms for updating person are located at the same page as data itself,
     * redirection is used.
     */

    public function updateAction ()
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
                    , 'action'     => 'retrieve'
                    , 'id'         => $this->params( )->fromRoute('id')
                )
            );
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
