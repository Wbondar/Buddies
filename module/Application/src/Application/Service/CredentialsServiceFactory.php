<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CredentialsServiceFactory
extends ApplicationServiceFactory
implements FactoryInterface
{
	public function createService (ServiceLocatorInterface $serviceLocator)
	{
		if (parent::createService($serviceLocator))
		{
			return new CredentialsService ($this->getObjectManager( ));	
		}
		throw new \Exception ("Failed to instantiate service.");
	}
}