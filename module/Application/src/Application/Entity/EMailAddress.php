<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * E-mail address entity.
 * Each person may own zero or more e-mail addresses. 
 * @Entity
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
