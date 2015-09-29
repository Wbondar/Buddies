<?php

namespace Domain\Model;

/**
 * Credentials entity.
 * Each person might have zero or more credentials.
 * Separated from person entity in order to 
 * save room for globalization.
 * @Entity
 */

class Credentials
{
	/**
	 * @var int
	 * @Id
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @var Person
	 * @ManyToOne(targetEntity="Person",inversedBy="credentials")
	 */
	private $owner;
	/**
	 * @var string
	 * @Column(type="string")
	 */
	private $nameFirst;
	/**
	 * @var string
	 * @Column(type="string")
	 */
	private $nameLast;
}