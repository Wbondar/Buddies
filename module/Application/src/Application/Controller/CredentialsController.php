<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CredentialsController 
extends ApplicationController
{
	private $credentialsService;

	public function __construct ($credentialsService)
	{
		$this->credentialsService = $credentialsService;
	}

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
