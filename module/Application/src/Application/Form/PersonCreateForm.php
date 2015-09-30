<?php

namespace Application\Form;

use Zend\Form\Form;

class PersonCreateForm
extends Form
{
	public function __construct ($name = null)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'id'
				, 'type' => 'hidden'
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'nameFirst'
				, 'type' => 'text'
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'nameLast'
				, 'type' => 'text'
			)
		)
		;
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