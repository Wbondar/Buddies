<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PhoneNumberController 
extends AbstractActionController
{
	private $phoneNumberService;

	public function __construct ($phoneNumberService)
	{
		$this->phoneNumberService = $phoneNumberService;
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
