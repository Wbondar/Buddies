<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\ContactCreateForm;

class ContactController 
extends ApplicationController
{
	private $contactService;
    private $personService;

	public function __construct ($contactService, $personService)
	{
		$this->contactService = $contactService;
        $this->personService = $personService;
	}

    public function createAction ()
    {
        if (!$this->isAuthenticated( ))
        {
            return $this->redirectToAuthentication( );
        }
         $form = new ContactCreateForm ("Create contact.");
         $source = $this->identity( )->getPerson( );
         $persons = array ( );
         $request = $this->getRequest();
         if ($request->isPost()) 
         {
            // TODO Implement input filter for form.
             //$form->setInputFilter(new ContactCreateInputFilter ( ));
             $form->setData($request->getPost());

             if ($form->isValid()) 
             {
                $contact = $this->contactService->create($source, $this->params( )->fromPost("id"));
                return $this->redirectToPersonalProfile( );
             }
         } else if ($request->isGet( )) {
            if ($target = $this->personService->retrieve($this->params( )->fromRoute("id")))
            {
                if (!$this->isMyself($target))
                { 
                    return array ('form' => $form, 'target' => $target);
                } else {
                    return $this->redirectToPersonalProfile( );
                }
            }
         }
    }

    public function destroyAction ()
    {
        if (!$this->isAuthenticated( ))
        {
            return $this->redirectToAuthentication( );
        }
        $source = $this->identity( )->getPerson( );
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            $this->contactService->destroy($source, $this->params( )->fromPost('id'));
        }
        return $this->redirectToPersonalProfile( );
    }
}
