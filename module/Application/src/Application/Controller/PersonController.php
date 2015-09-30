<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Entity\Person;
use Application\Form\PersonCreateForm;

class PersonController 
extends AbstractActionController
{
	private $personService;

	public function __construct ($personService)
	{
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

    public function retrieveAction ()
    {
        $request = $this->getRequest( );
        if ($request->isGet( ))
        {
            $id = $this->params( )->fromRoute("id");
            $person = $this->personService->retrieve($id);
            return array('person' => $person);   
        }
        // TODO Implement proper 404 error handling.
        return array ( );
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
