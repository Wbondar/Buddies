<?php

namespace Application\Form;

use Zend\Form\Form;

class PhoneNumberCreateForm
extends Form
{
	public function __construct ($name)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'owner_id'
				, 'type' => 'hidden'
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'value'
				, 'type' => 'text'
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