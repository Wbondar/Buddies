<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\AccountService;
use Application\Form\AccountCreateForm;
use Application\Form\SessionInvalidateForm;

/**
 * 
 * Account controller handles sessions and registration.
 * 
 * @author wbondarenko@programmer.net
 *
 */

class AccountController 
extends ApplicationController
{
	private $accountService;

	public function __construct (AccountService $accountService)
	{
		$this->accountService = $accountService;
	}
	
	/**
	 * Handles creation of an account that is registering (signing up) to the system on a POST request.
	 * Renders appropriate HTML form on a GET request.
	 * Redirects to personal profile page if user is logged in.
	 * @throws \Exception
	 */

    public function createAction ( )
    {
        if ($this->accountService->isAuthenticated( ))
        {
            return $this->redirectToPersonalProfile( );
        }
         $form = new AccountCreateForm( );

         $request = $this->getRequest();
         if ($request->isPost()) 
         {
            // TODO Implement input filter for form.
            //$form->setInputFilter(new AccountCreateInputFilter ( ));
            $form->setData($request->getPost());

            if ($form->isValid()) 
            {
                try
                {
                    $username = $this->params( )->fromPost("username");
                    $password = $this->params( )->fromPost("password");
                    $account = $this->accountService->create($username,$password);
                    if ($account) 
                    {
                        return $this->redirectToPersonalProfile( );
                    } else {
                        throw new \Exception ("Unknown internal error.");
                    }
                } catch (\Exception $e) {
                    throw new \Exception ("Failed to create new account.", 400, $e);
                }
            }
        }
        return array('form' => $form);
    }
    
    /**
     * Authenticates a user to the system that is creates session on POST request.
     * Renders appropriate HTML form on GET request.
     * Redirects to the personal profile page is user is already logged in.
     * @throws \Exception
     * @return multitype:\Application\Form\AccountCreateForm
     */

    public function authenticateAction ( )
    {
        if ($this->accountService->isAuthenticated( ))
        {
            return $this->redirectToPersonalProfile( );
        }
         $form = new AccountCreateForm( );

         $request = $this->getRequest();
         if ($request->isPost()) 
         {
            // TODO Implement input filter for form.
            //$form->setInputFilter(new AuthenticateInputFilter ( ));
            $form->setData($request->getPost());

            if ($form->isValid()) 
            {
                try
                {
                    $person = $this->accountService->authenticate($this->params( )->fromPost("username"), $this->params( )->fromPost("password"));
                    return $this->redirect()->toRoute('application', array('controller' => 'person', 'action' => 'myself'));
                } catch (\Exception $e) {
                    throw new \Exception ("Failed to authenticate.", 400, $e);
                }
            }
         }
         return array('form' => $form);
    }
    
    /**
     * Destroys session that is logs out user from the system on POST request.
     * Renders appropriate HTML form on GET request.
     * Redirects the user to the authentication page if user is not logged in.
     * @return multitype:\Application\Form\SessionInvalidateForm
     */

    public function exitAction ( )
    {
        if (!$this->accountService->isAuthenticated( ))
        {
            return $this->redirectToAuthentication( );
        }
         $form = new SessionInvalidateForm( );

         $request = $this->getRequest();
         if ($request->isPost()) 
         {
             $form->setData($request->getPost());

             if ($form->isValid()) 
             {
                $this->accountService->invalidateSession( );
                return $this->redirectToAuthentication( );
             }
         }
         return array('form' => $form);
    }
}
