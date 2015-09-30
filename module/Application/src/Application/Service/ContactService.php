<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

class ContactService
{
	private $objectManager;
	private $personRepo;
	private $contactRepo;

	public function __construct (ObjectManager $objectManager)
    {
    	$this->objectManager   = $objectManager;
		$this->personRepo      = $objectManager->getRepository('Application\Entity\Person');
		$this->contactRepo     = $objectManager->getRepository('Application\Entity\Contact');
    }

	public function create (Person $source, Person $target)
	{
		$contact = new Contact ( );
		$contact->setSource($source);
		$contact->setTarget($target);
		$objectManager->persist($contact);
		$objectManager->flush( );
		return $contact;
	}

	public function retrieve ($id)
	{
		return $contactRepo->find($id);
	}

	public function destroy (Contact $contact)
	{
		return $contactRepo->destroy($contact);
	}
}