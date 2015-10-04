<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\EMailAddressCreateForm;

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
	 * adds it to the set of e-mail addresses of a currently logged in user
	 * on a POST request.
	 * Redirects to the personal profile on success.
	 */

    public function createAction ()
    {
    	$request = $this->getRequest( );
    	if ($request->isPost( ))
    	{
	    	if ($account = $this->identity( ))
	    	{
	    		if ($person = $account->getPerson( ))
	    		{
	    			$form = new EMailAddressCreateForm( );
	    			$form->setData($request->getPost( ));
	    			if ($form->isValid( ))
	    			{
	    				$value = $form->getData( )['value'];
			    		$this->emailAddressService->create($person, $value);
			    		return $this->redirectToPersonalProfile( );
	    			} else {
                		$this->layout( )->messages = $form->getMessages( );
                		return array ('form' => $form);
            		}
	    		}
	    	}
    	}
    	return $this->redirectToAuthentication( );
    }
	
	/**
	 * Destroys an e-mail address and 
	 * removes it from the set of e-mail addresses of a currently logged in user
	 * on a POST request.
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
