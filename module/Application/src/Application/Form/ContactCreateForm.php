<?php

namespace Application\Form;

use Zend\Form\Form;

class ContactCreateForm
extends Form
{
	public function __construct ($name)
	{
		parent::__construct($name);
		$this->add
		(
			array
			(
			    'type' => 'hidden',
			    'name' => 'source_id'
			)
		);
		$this->add
		(
			array
			(
			    'type' => 'hidden',
			    'name' => 'target_id'
			)
		);
		/*$this->add
		(
			array
			(
			    'type' => 'DoctrineModule\Form\Element\ObjectHidden',
			    'name' => 'source',
			    'options' => array
			    (
			        'object_manager' => $objectManager,
			        'target_class'   => 'Application\Entity\Person',
			        'property'       => 'id',
			    )
			)
		);
		$this->add
		(
			array
			(
			    'type' => 'DoctrineModule\Form\Element\ObjectHidden',
			    'name' => 'target',
			    'options' => array
			    (
			        'object_manager' => $objectManager,
			        'target_class'   => 'Application\Entity\Person',
			        'property'       => 'id',
			    )
			)
		);*/
		$this->add
		(
			array 
			(
				'name' => 'submit', 'type' => 'submit'
			)
		)
		;
	}
}