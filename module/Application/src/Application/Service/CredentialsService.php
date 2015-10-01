<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

/**
 * Create, retreieve, update and destroy logic for credentials.
 */

class CredentialsService
{
	private $objectManager;
	private $personRepo;
	private $credentialsRepo;

	public function __construct (ObjectManager $objectManager)
    {
    	$this->objectManager   = $objectManager;
		$this->personRepo      = $objectManager->getRepository('Application\Entity\Person');
		$this->credentialsRepo = $objectManager->getRepository('Application\Entity\Credentials');
    }

	public function create (Person $owner, $nameFirst, $nameLast)
	{
		$credentials = new Credentials ( );
		$credentials->setOwner($owner);
		$credentials->setNameFirst($nameFirst);
		$credentials->setNameLast($nameLast);
		$this->objectManager->persist($credentials);
		$this->objectManager->flush( );
		return $credentials;
	}

	public function retrieve ($id)
	{
		return $this->credentialsRepo->find($id);
	}

	public function destroy (Credentials $credentials)
	{
		return $this->credentialsRepo->destroy($credentials);
	}
}