<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\PhoneNumberService;

/**
 * Controller, responsible for creation and destruction of phone numbers.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class PhoneNumberController 
extends ApplicationController
{
	private $phoneNumberService;

	public function __construct (PhoneNumberService $phoneNumberService)
	{
		$this->phoneNumberService = $phoneNumberService;
	}
	
		
	/**
	 * Creates new phone number and 
	 * adds it to the set of phone numbers of a currently logged in user on a POST request.
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
                    $form = new PhoneNumberCreateForm( );
                    $form->setData($request->getPost( ));
                    if ($form->isValid( ))
                    {
                        $value = $form->getData( )['value'];
                        $this->phoneNumberService->create($person, $value);
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
     * Destroys phone number and
     * removes it from the set of phone numbers of a currently logged in user.
     * Does not check validity.
     * Redirects to the personal profile regardless of the outcome.
     */
    
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
