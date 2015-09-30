<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CredentialsControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$personService = $serviceLocator->getServiceLocator()->get('Application\Service\Credentials');
		return new CredentialsController($personService);
	}
}