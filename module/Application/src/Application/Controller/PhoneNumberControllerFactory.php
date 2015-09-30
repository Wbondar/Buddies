<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhoneNumberControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$personService = $serviceLocator->getServiceLocator()->get('Application\Service\PhoneNumber');
		return new PhoneNumberController($personService);
	}
}