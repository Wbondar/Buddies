<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\ContactCreateForm;
use Application\Service\ContactService;
use Application\Service\PersonService;

/**
 * 
 * Controller responsible for creation and destruction of contacts.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class ContactController 
extends ApplicationController
{
	private $contactService;
    private $personService;

	public function __construct (ContactService $contactService, PersonService $personService)
	{
		$this->contactService = $contactService;
        $this->personService = $personService;
	}
	
	/**
	 * Creates new contact on POST.
	 * Also partly responsible for ensuring that creation is possible.
	 * Renders appropriate HTML page on GET.
	 * Redirects to the authentication page is user is not logged in.
	 */

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
             } else {
                $this->layout( )->messages = $form->getMessages( );
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
    
    /**
     * Destroys a contact on POST.
     * Renders appropriate HTML page on GET.
     * Redirects to authentication page if user is not logged in.
     */

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
