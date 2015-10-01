<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PersonControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$accountService = $serviceLocator->getServiceLocator()->get('Application\Service\Account');
		if ($accountService == null)
		{
			throw new \Exception ("Failed to locate account service.");
		}
		$personService = $serviceLocator->getServiceLocator()->get('Application\Service\Person');
		if ($personService == null)
		{
			throw new \Exception ("Failed to locate person service.");
		}
		return new PersonController($accountService, $personService);
	}
}