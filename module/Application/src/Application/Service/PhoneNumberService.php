<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

/**
 * Create, retreieve, update and destroy logic for phone numbers.
 */

class PhoneNumberService
{
	private $objectManager;
	private $personRepo;
	private $phoneNumberRepo;

	public function __construct (ObjectManager $objectManager)
    {
    	$this->objectManager   = $objectManager;
		$this->personRepo      = $objectManager->getRepository('Application\Entity\Person');
		$this->phoneNumberRepo = $objectManager->getRepository('Application\Entity\PhoneNumber');
    }

	public function create (Person $owner, $value)
	{
		$phoneNumber = new PhoneNumber ( );
		$phoneNumber->setOwner($owner);
		$phoneNumber->setValue($value);
		$this->objectManager->persist($phoneNumber);
		$this->objectManager->flush( );
		return $phoneNumber;
	}

	public function retrieve ($id)
	{
		return $this->phoneNumberRepo->find($id);
	}

	public function retrieveBy ($traits)
	{
		return $this->phoneNumberRepo->findBy($traits);
	}

	public function destroy (PhoneNumber $phoneNumber)
	{
		return $this->phoneNumberRepo->destroy($phoneNumber);
	}
}