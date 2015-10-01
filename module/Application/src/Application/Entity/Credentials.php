<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Credentials entity.
 * Each person might have zero or more credentials.
 * Separated from person entity in order to 
 * save room for globalization.
 * @Entity
 * @Table(uniqueConstraints={@UniqueConstraint(name="uk_credentials_nameFirst_nameLast", columns={"nameFirst", "nameLast"}),@UniqueConstraint(name="uk_credentials_owner_id_id", columns={"owner_id", "id"})})
 */

class Credentials
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
	 * @Column(type="string",nullable=true)
	 */
	private $nameLast;

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
     * Set nameFirst
     *
     * @param string $nameFirst
     * @return Credentials
     */
    public function setNameFirst($nameFirst)
    {
        $this->nameFirst = $nameFirst;

        return $this;
    }

    /**
     * Get nameFirst
     *
     * @return string 
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * Set nameLast
     *
     * @param string $nameLast
     * @return Credentials
     */
    public function setNameLast($nameLast)
    {
        $this->nameLast = $nameLast;

        return $this;
    }

    /**
     * Get nameLast
     *
     * @return string 
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * Set owner
     *
     * @param \Application\Entity\Person $owner
     * @return Credentials
     */
    public function setOwner(\Application\Entity\Person $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Application\Entity\Person 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
