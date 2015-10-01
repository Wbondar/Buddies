<?php

namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Application\Entity\Account;
use Application\Entity\Credentials;
use Application\Entity\Contact;
use Application\Entity\Person;
use Application\Entity\EMailAddress;

/**
 * Create, retreieve, update and destroy logic for e-mail addresses.
 */

class EMailAddressService
{
	private $objectManager;
	private $personRepo;
	private $emailAddressRepo;

	public function __construct (ObjectManager $objectManager)
    {
    	$this->objectManager   = $objectManager;
		$this->personRepo      = $objectManager->getRepository('Application\Entity\Person');
		$this->emailAddressRepo = $objectManager->getRepository('Application\Entity\EMailAddress');
    }

	public function create (Person $owner, $value)
	{
		$emailAddress = new EMailAddress ( );
		$emailAddress->setOwner($owner);
		$emailAddress->setValue($value);
		$this->objectManager->persist($emailAddress);
		$this->objectManager->flush( );
		return $emailAddress;
	}

	public function retrieve ($id)
	{
		return $this->emailAddressRepo->find($id);
	}

	public function retrieveBy ($traits)
	{
		return $this->emailAddressRepo->findBy($traits);
	}
	
	/**
	 * Takes $account that is user attempting to delete e-mail address to the database
	 * and id of e-mail address to delete.
	 * If the user appears to be the owner of the e-mail address, delete the e-mail address.
	 * Do nothing overwise.
	 * @param \Application\Entity\Account $account
	 * @param string $emailAddressId
	 */

	public function destroy (\Application\Entity\Account $account, $emailAddressId)
	{
		$emailAddress = $this->retrieve($emailAddressId);
		if ($account->getPerson( )->getEMailAddresses( )->contains($emailAddress))
		{
			$this->objectManager->remove($emailAddress);
			$this->objectManager->flush( );
		}
	}
}