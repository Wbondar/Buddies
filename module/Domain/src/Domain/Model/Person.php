<?php

namespace Domain\Model;

/**
 * Person entity.
 * @Entity 
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
	private $phoneNumers;
	/**
	 * @var Contact[]
	 * @OneToMany(targetEntity="Contact",mappedBy="source")
	 */
	private $contacts;

	public functinon __construct ( )
	{
		$this->credentials = ArrayCollection ( );
		$this->phoneNumbers = ArrayCollection ( );
		$this->contacts = ArrayCollection ( );
	}
}