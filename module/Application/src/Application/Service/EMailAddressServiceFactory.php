<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EMailAddressServiceFactory
extends ApplicationServiceFactory
implements FactoryInterface
{
	public function createService (ServiceLocatorInterface $serviceLocator)
	{
		if (parent::createService($serviceLocator))
		{
			return new EMailAddressService ($this->getObjectManager( ));	
		}
		throw new \Exception ("Failed to instantiate service.");
	}
}