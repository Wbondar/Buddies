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
 * Contact entity.
 * Handles relationship between two person.
 * Connection between two persons may be established only once.
 * Entity does not guarantee that relationship between persons is bidirectional.
 * That logic is handled by a \Application\Service\PersonService class.
 * Contact is not mandatory bidirectional in order to save room for different types of contacts.
 * For example, relationship parent-child is not bidirectional.
 * @Entity
 * @Table(uniqueConstraints={@UniqueConstraint(name="uk_contact_source_id_target_id", columns={"source_id", "target_id"})})
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
	 * @ManyToOne(targetEntity="Person", inversedBy="contacts")
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
     * Set dateEstablished
     *
     * @param \DateTime $dateEstablished
     * @return Contact
     */
    public function setDateEstablished($dateEstablished)
    {
        $this->dateEstablished = $dateEstablished;

        return $this;
    }

    /**
     * Get dateEstablished
     *
     * @return \DateTime 
     */
    public function getDateEstablished()
    {
        return $this->dateEstablished;
    }

    /**
     * Set source
     *
     * @param \Application\Entity\Person $source
     * @return Contact
     */
    public function setSource(\Application\Entity\Person $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Application\Entity\Person 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param \Application\Entity\Person $target
     * @return Contact
     */
    public function setTarget(\Application\Entity\Person $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \Application\Entity\Person 
     */
    public function getTarget()
    {
        return $this->target;
    }
}
