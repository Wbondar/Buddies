<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\CredentialsService;

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
	 * Redirects to personal profile page regardless of the outcome. 
	 */

    public function updateAction ()
    {
    	$request = $this->getRequest( );
    	if ($request->isPost( ))
    	{
	    	if ($this->isAuthenticated( ))
	    	{
		    	$person = $this->identity( )->getPerson( );
		    	$nameFirst = $this->params( )->fromPost('nameFirst');
		    	$nameLast = $this->params( )->fromPost('nameLast');
		        $this->credentialsService->update($person, $nameFirst, $nameLast);	
	    	}	
    	}
    	return $this->redirectToPersonalProfile( );
    }
}
