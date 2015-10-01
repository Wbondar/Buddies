<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\PhoneNumber;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 * Create, retreieve, update and destroy logic for contacts.
 */

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

	public function create ($data)
	{
		$contact = new Contact ( );
		$source = $this->personRepo->find($data['source_id']);
		$contact->setSource($source);
		$target = $this->personRepo->find($data['target_id']);
		$contact->setTarget($target);
		$contact->setDateEstablished(new \DateTime ( ));
		/*
		 * Note: This does not look pretty, but in order to 
		 * save room for different types of contacts,
		 * which might not be bidiretional,
		 * database entry duplicated.
		 */
		$reflectedContact = new Contact ( );
		$reflectedContact->setSource($target);
		$reflectedContact->setTarget($source);
		$reflectedContact->setDateEstablished(new \DateTime ( ));
		$this->objectManager->persist($contact);
		$this->objectManager->persist($reflectedContact);
		$this->objectManager->flush( );
		return $contact;
	}

	public function retrieve ($id)
	{
		return $this->contactRepo->find($id);
	}

	public function destroy (Contact $contact)
	{
		return $this->contactRepo->destroy($contact);
	}
}