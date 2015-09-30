<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\ContactCreateForm;

class ContactController 
extends AbstractActionController
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
         $form = new ContactCreateForm ("Create contact.");
         $source = $this->personService->retrieve($this->params( )->fromRoute("id"));
         $persons = array ( );
         $request = $this->getRequest();
         if ($request->isPost()) {
            // TODO Implement input filter for form.
             //$form->setInputFilter(new ContactCreateInputFilter ( ));
             $form->setData($request->getPost());

             if ($form->isValid()) {
                $contact = $this->contactService->create($form->getData( ));
                return $this->redirect()->toRoute('application', array('controller' => 'person', 'action' => 'retrieve', 'id' => $source->getId( )));
             }
         } else if ($request->isGet( )) {
            $persons = $this->personService->retrieveWithCredentialsLike($this->params( )->fromQuery("trait"));
         }
         return array('persons' => $persons, 'form' => $form, 'source' => $source);
    }

    public function retrieveAction ()
    {
        return new ViewModel();
    }

    public function updateAction ()
    {
        return new ViewModel();
    }

    public function destroyAction ()
    {
        return new ViewModel();
    }
}
