<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PhoneNumberController 
extends ApplicationController
{
	private $phoneNumberService;

	public function __construct ($phoneNumberService)
	{
		$this->phoneNumberService = $phoneNumberService;
	}

    public function createAction ()
    {
    	if ($account = $this->identity( ))
    	{
    		$this->phoneNumberService->create($account->getPerson( ), $this->params( )->fromPost('value'));
    		return $this->redirectToPersonalProfile( );
    	}
    	return $this->redirectToAuthentication( );
    }

    public function destroyAction ()
    {
    	if ($account = $this->identity( ))
    	{
    		$this->phoneNumberService->destroy($account, $this->params( )->fromPost('id'));
    		return $this->redirectToPersonalProfile( );
    	}
    	return $this->redirectToAuthentication( );
    }
}
