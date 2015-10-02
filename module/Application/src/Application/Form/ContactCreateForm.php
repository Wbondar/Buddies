<?php

namespace Application\Form;

use Zend\Form\Form;

class ContactCreateForm
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
			    'name' => 'id'
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