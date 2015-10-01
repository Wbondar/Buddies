<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Account entity.
 * </p>
 * Each account corresponds to one and only one person.
 * Multiple accounts can not correspond to the same person or the same identity.
 * But, since user of the application is not necesserely a single person,
 * information needed for authentication is stored separately.
 * </p>
 * For person in order to exist in the database of the application
 * is not obligatory to have an account.
 * It is done so in order to make possible to add to the system information about,
 * for example, already passed historical persons.
 * @Entity
 */

class Account
{
	/**
	 * @var int 
	 * @Id
	 * @GeneratedValue
	 * @Column(type="integer")
	 */
	private $id;

    /**
     * @var string
     * @Column(type="string",unique=true)
     */
    private $username;

    /**
     * @var string
     * @Column(type="text")
     */
    private $password;

	/**
	 * @var Person
	 * @OneToOne(targetEntity="Person")
	 */
    private $person;

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
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set person
     *
     * @param string $person
     * @return Account
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string 
     */
    public function getPerson()
    {
        return $this->person;
    }
}
