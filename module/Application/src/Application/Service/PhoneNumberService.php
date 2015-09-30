<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

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
		$objectManager->persist($phoneNumber);
		$objectManager->flush( );
		return $phoneNumber;
	}

	public function retrieve ($id)
	{
		return $phoneNumberRepo->find($id);
	}

	public function destroy (PhoneNumber $phoneNumber)
	{
		return $phoneNumberRepo->destroy($phoneNumber);
	}
}