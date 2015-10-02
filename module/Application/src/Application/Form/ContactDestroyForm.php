<?php

namespace Application\Form;

use Zend\Form\Form;

class ContactDestroyForm
extends Form
{
	public function __construct ($name = null)
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
		$this->add
		(
			array 
			(
				  'name' => 'submit'
				, 'type' => 'submit'
			)
		)
		;
	}
}