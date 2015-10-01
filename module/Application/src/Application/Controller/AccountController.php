<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\AccountCreateForm;
use Application\Form\SessionInvalidateForm;

class AccountController 
extends AbstractActionController
{
	private $accountService;

	public function __construct ($accountService)
	{
		$this->accountService = $accountService;
	}

    private function redirectToPersonalProfile( )
    {
        $this->getResponse( )->setStatusCode(400);
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
        $this->getResponse( )->setStatusCode(400);
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
