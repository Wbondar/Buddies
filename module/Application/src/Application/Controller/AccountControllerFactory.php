<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccountControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$accountService = $serviceLocator->getServiceLocator()->get('Application\Service\Account');
		return new AccountController($accountService);
	}
}