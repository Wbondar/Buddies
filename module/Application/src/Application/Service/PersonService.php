<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

/**
 * Create, retreieve, update and destroy logic for persons.
 */

class PersonService
{
	private $objectManager;
	private $personRepo;
	private $credentialsRepo;
	private $phoneNumberRepo;
	private $contactRepo;

	public function __construct (ObjectManager $objectManager)
    {
    	$this->objectManager   = $objectManager;
		$this->personRepo      = $objectManager->getRepository('Application\Entity\Person');
		$this->credentialsRepo = $objectManager->getRepository('Application\Entity\Credentials');
		$this->phoneNumberRepo = $objectManager->getRepository('Application\Entity\PhoneNumber');
		$this->contactRepo     = $objectManager->getRepository('Application\Entity\Contact');
    }

	public function create ($data)
	{
		var_dump($data);
		$hydrator = new DoctrineObject($this->objectManager, 'Application\Entity\Credentials');
		$person = new Person ( );
		$credentials = new Credentials ( );
		$credentials->setOwner($person);
		$hydrator->hydrate($data, $credentials);
		$person->addCredential($credentials);
		$this->objectManager->persist($person);
		$this->objectManager->flush( );
		return $person;
	}

	public function retrieve ($id)
	{
		return $this->personRepo->find($id);
	}

	public function retrieveWithCredentialsLike ($trait)
	{
		return $this->personRepo->findWithCredentialsLike($trait);
	}

	public function destroy (Person $person)
	{
		return $this->personRepo->destroy($person);
	}
}