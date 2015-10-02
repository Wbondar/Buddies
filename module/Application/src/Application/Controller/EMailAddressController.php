<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Controller, responsible for creation and destruction of e-mail addresses.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class EMailAddressController 
extends ApplicationController
{
	private $emailAddressService;

	public function __construct ($emailAddressService)
	{
		$this->emailAddressService = $emailAddressService;
	}
	
	/**
	 * Creates new e-mail address and 
	 * adds it to the set of e-mail addresses of a currently logged in user.
	 * Does not check validity.
	 * Redirects to the personal profile regardless of the outcome.
	 */

    public function createAction ()
    {
    	if ($account = $this->identity( ))
    	{
    		$this->emailAddressService->create($account->getPerson( ), $this->params( )->fromPost('value'));
    		return $this->redirectToPersonalProfile( );
    	}
    	return $this->redirectToAuthentication( );
    }
	
	/**
	 * Destroys an e-mail address and 
	 * removes it from the set of e-mail addresses of a currently logged in user.
	 * Does not check validity.
	 * Redirects to the personal profile regardless of the outcome.
	 */

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
