<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Person entity.
 * Each person may have zero or more contacts.
 * Each person must have at least one instance of credentials.
 * That is not really checked by the application at the moment.
 * It is just not exposed to the end user that such an entity exists in the system
 * and there is no legal way for an end-user to create or destroy instance of this entity.
 * Each person may have zero or more e-mail addresses.
 * Each person may have zero or more phone numbers.
 * @Entity(repositoryClass="PersonRepository")
 */

class Person
{
	/**
	 * @var int 
	 * @Id
	 * @GeneratedValue
	 * @Column(type="integer")
	 */
	private $id;
	/**
	 * @var Credentials[]
	 * @OneToMany(targetEntity="Credentials",mappedBy="owner")
	 */
	private $credentials;
    /**
     * @var PhoneNumber[]
     * @OneToMany(targetEntity="PhoneNumber",mappedBy="owner")
     */ 
    private $phoneNumbers;
    /**
     * @var EMailAddress[]
     * @OneToMany(targetEntity="EMailAddress",mappedBy="owner")
     */ 
    private $emailAddresses;
	/**
	 * @var Contact[]
	 * @OneToMany(targetEntity="Contact",mappedBy="source")
	 */
	private $contacts;

	public function __construct ( )
	{
		$this->credentials    = new ArrayCollection ( );
        $this->phoneNumbers   = new ArrayCollection ( );
        $this->emailAddresses = new ArrayCollection ( );
		$this->contacts       = new ArrayCollection ( );
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add credentials
     *
     * @param \Application\Entity\Credentials $credentials
     * @return Person
     */
    public function addCredential(\Application\Entity\Credentials $credentials)
    {
        $this->credentials[] = $credentials;

        return $this;
    }

    /**
     * Remove credentials
     *
     * @param \Application\Entity\Credentials $credentials
     */
    public function removeCredential(\Application\Entity\Credentials $credentials)
    {
        $this->credentials->removeElement($credentials);
    }

    /**
     * Get credentials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Add phoneNumbers
     *
     * @param \Application\Entity\PhoneNumber $phoneNumbers
     * @return Person
     */
    public function addPhoneNumber(\Application\Entity\PhoneNumber $phoneNumbers)
    {
        $this->phoneNumbers[] = $phoneNumbers;

        return $this;
    }

    /**
     * Remove phoneNumbers
     *
     * @param \Application\Entity\PhoneNumber $phoneNumbers
     */
    public function removePhoneNumber(\Application\Entity\PhoneNumber $phoneNumbers)
    {
        $this->phoneNumbers->removeElement($phoneNumbers);
    }

    /**
     * Get phoneNumbers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Add contacts
     *
     * @param \Application\Entity\Contact $contacts
     * @return Person
     */
    public function addContact(\Application\Entity\Contact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Application\Entity\Contact $contacts
     */
    public function removeContact(\Application\Entity\Contact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add emailAddresses
     *
     * @param \Application\Entity\EMailAddress $emailAddresses
     * @return Person
     */
    public function addEmailAddress(\Application\Entity\EMailAddress $emailAddresses)
    {
        $this->emailAddresses[] = $emailAddresses;

        return $this;
    }

    /**
     * Remove emailAddresses
     *
     * @param \Application\Entity\EMailAddress $emailAddresses
     */
    public function removeEmailAddress(\Application\Entity\EMailAddress $emailAddresses)
    {
        $this->emailAddresses->removeElement($emailAddresses);
    }

    /**
     * Get emailAddresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }
}
