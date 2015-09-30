<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class ApplicationServiceFactory
implements FactoryInterface
{
	private $objectManager;

	protected function getObjectManager ( )
	{
		return $this->objectManager;
	}

	public function createService (ServiceLocatorInterface $serviceLocator)
	{
		$objectManager = $serviceLocator->get("Doctrine\ORM\EntityManager");
		if ($objectManager == null)
		{
			throw new \Exception ("Failed to locate object manager.");
			return false;
		}
		$this->objectManager = $objectManager;
		return ($this->objectManager != null);
	}
}