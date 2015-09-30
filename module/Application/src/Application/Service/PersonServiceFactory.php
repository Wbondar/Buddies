<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PersonServiceFactory
extends ApplicationServiceFactory
implements FactoryInterface
{
	public function createService (ServiceLocatorInterface $serviceLocator)
	{
		if (parent::createService($serviceLocator))
		{
			return new PersonService ($this->getObjectManager( ));	
		}
		throw new \Exception ("Failed to instantiate service.");
	}
}