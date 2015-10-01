<?php
namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EMailAddressControllerFactory 
implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$emailAddressService = $serviceLocator->getServiceLocator()->get('Application\Service\EMailAddress');
		return new EMailAddressController($emailAddressService);
	}
}