<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PersonControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$personService = $serviceLocator->getServiceLocator()->get('Application\Service\Person');
		if ($personService == null)
		{
			throw new \Exception ("Failed to locate service.");
		}
		return new PersonController($personService);
	}
}