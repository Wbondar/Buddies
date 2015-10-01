<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EMailAddressController 
extends ApplicationController
{
	private $emailAddressService;

	public function __construct ($emailAddressService)
	{
		$this->emailAddressService = $emailAddressService;
	}

    public function createAction ()
    {
    	if ($account = $this->identity( ))
    	{
    		$this->emailAddressService->create($account->getPerson( ), $this->params( )->fromPost('value'));
    		return $this->redirectToPersonalProfile( );
    	}
    	return $this->redirectToAuthentication( );
    }

    public function destroyAction ()
    {
    	if ($account = $this->identity( ))
    	{
    		$this->emailAddressService->destroy($account, $this->params( )->fromPost('id'));
    		return $this->redirectToPersonalProfile( );
    	}
    	return $this->redirectToAuthentication( );
    }
}
