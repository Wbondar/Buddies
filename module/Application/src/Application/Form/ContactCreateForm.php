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
				  'name' => 'source_id'
				, 'type' => 'hidden'
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'target_id'
				, 'type' => 'hidden'
			)
		)
		;
		$this->add
		(
			array 
			(
				'type' => 'submit'
			)
		)
		;
	}
}