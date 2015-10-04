<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\CredentialsService;
use Application\Form\CredentialsUpdateForm;

/**
 * Controller, responsible for updating name of a perosn.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class CredentialsController 
extends ApplicationController
{
	private $credentialsService;

	public function __construct (CredentialsService $credentialsService)
	{
		$this->credentialsService = $credentialsService;
	}
	
	/**
	 * Updates credentials (that is name) of a logged in person on POST.
	 * Redirects to personal profile page on success. 
	 */

    public function updateAction ()
    {
    	$request = $this->getRequest( );
    	if ($request->isPost( ))
    	{
	    	if ($this->isAuthenticated( ))
	    	{
         		$form = new CredentialsUpdateForm( );
            	$form->setData($request->getPost());
            	if ($form->isValid( ))
            	{
			    	$person = $this->identity( )->getPerson( );
			    	$nameFirst = $form->getData( )['nameFirst'];
			    	$nameLast = $form->getData( )['nameLast'];
			        $this->credentialsService->update($person, $nameFirst, $nameLast);	
            	} else {
                	$this->layout( )->messages = $form->getMessages( );
                	return array ('form' => $form);
            	}
	    	}	
    	}
    	return $this->redirectToPersonalProfile( );
    }
}
