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
    
    /**
     * Creates bidirectional contact between $initiator
     * and person of id $idOfTarget.
     * If there is no person of id $idOfTarget
     * throw an exception.
     * If those have the same id's, do nothing.
     * @param Person $initiator
     * @param unknown $idOfTarget
     * @throws \Exception
     */

	public function create (Person $initiator, $idOfTarget)
	{
		$target = $this->personRepo->find($idOfTarget);
		if ($target == null)
		{
			throw new \Exception ("There is no person of id \"" . $idOfTarget . "\".");
		}
		if ($target->getId( ) == $initiator->getId( ))
		{
			/* You cannot contact yourself. */
			return null;
		}
			
		$contact = new Contact ( );
		$contact->setSource($initiator);
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
		$reflectedContact->setTarget($initiator);
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

	public function destroy (Person $source, $idOfContact)
	{
		$contact = $this->retrieve($idOfContact);
		if ($source->getContacts( )->contains($contact))
		{
			$this->objectManager->remove($contact);
			/*
			 * Note: Reflected contact might not be needed for other types of contacts.
			 * TODO Implement DQL query for handling deletion of bidirectional contacts.
			 */
			foreach ($contact->getTarget( )->getContacts( ) as $reflectedContact)
			{
				if ($reflectedContact->getTarget( )->getId( ) == $source->getId( ))
				{
					$this->objectManager->remove($reflectedContact);
				}
			}
			$this->objectManager->flush( );
		}
	}
}