<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * E-mail address entity.
 * Each e-mail address corresponds to one and only one person.
 * @Entity
 * @Table(uniqueConstraints={@UniqueConstraint(columns={"owner_id", "id"})})
 */

class EMailAddress
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
	 * @ManyToOne(targetEntity="Person",inversedBy="emailAddresses")
	 */
	private $owner;
	/**
	 * @var string
	 * @Column(type="string",unique=true)
	 */
	private $value;

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
     * Set value
     *
     * @param string $value
     * @return EMailAddress
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set owner
     *
     * @param \Application\Entity\Person $owner
     * @return EMailAddress
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
