<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CredentialsController 
extends AbstractActionController
{
	private $credentialsService;

	public function __construct ($credentialsService)
	{
		$this->credentialsService = $credentialsService;
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
