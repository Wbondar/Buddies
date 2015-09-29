<?php

namespace Domain\Model;

/**
 * Phone number entity.
 * Each person may own zero or more phone numbers. 
 * @Entity
 */

class PhoneNumber
{
	/**
	 * @var int
	 * @Id
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @var Person
	 * @ManyToOne(targetEntity="Person",inversedBy="phoneNumbers")
	 */
	private $owner;
	/**
	 * @var string
	 * @Column(type="string",unique=true)
	 */
	private $value;
}