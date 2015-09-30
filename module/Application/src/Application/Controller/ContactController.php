<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController 
extends AbstractActionController
{
	private $contactService;

	public function __construct ($contactService)
	{
		$this->contactService = $contactService;
	}

    public function createAction ()
    {
        return new ViewModel();
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
