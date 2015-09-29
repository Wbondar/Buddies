<?php

namespace Domain\Model;

/**
 * Contact entity.
 * Each person may have zero or more contacts.
 * @Entity
 */

class Contact
{
	/**
	 * @var int
	 * @Id
	 * @GeneratedValue
	 * @Column(type="integer")
	 */
	private $id;
	/**
	 * @var Person
	 * @ManyToOne(targetEntity="Person",inversedBy="contacts")
	 */
	private $source;
	/**
	 * @var Person
	 * @ManyToOne(targetEntity="Person")
	 */
	private $target;
	/**
	 * @var \DateTime 
	 * @Column(type="datetime")
	 */
	private $dateEstablished;
}