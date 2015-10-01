<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Account;
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
	
	/**
	 * Takes $account that is user attempting to delete phone number to the database
	 * and id of phone number to delete.
	 * If the user appears to be the owner of the phone number, delete the phone number.
	 * Do nothing overwise.
	 * @param \Application\Entity\Account $account
	 * @param string $phoneNumberId
	 */

	public function destroy (\Application\Entity\Account $account, $phoneNumberId)
	{
		$phoneNumber = $this->retrieve($phoneNumberId);
		if ($account->getPerson( )->getPhoneNumbers( )->contains($phoneNumber))
		{
			$this->objectManager->remove($phoneNumber);
			$this->objectManager->flush( );
		}
	}
}