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

    private function redirectToPersonalProfile( )
    {
        return $this
            ->redirect( )
            ->toRoute
            (
                  'application'
                , array
                (
                      'controller' => 'person'
                    , 'action'     => 'myself'
                )
            );
    }

    private function redirectToAuthentication( )
    {
        return $this
            ->redirect( )
            ->toRoute
            (
                  'application'
                , array
                (
                      'controller' => 'account'
                    , 'action'     => 'authenticate'
                )
            );
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
