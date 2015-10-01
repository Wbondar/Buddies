<?php

namespace Application\Form;

use Zend\Form\Form;

class PersonRetrieveByCredentialsForm
extends Form
{
	public function __construct ($name = null)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'trait'
				, 'attributes' => array
				(
			         'type' => 'text'
			        , 'required' => 'required'
			        , 'pattern'  => '^[a-zA-Z][a-zA-Z0-9-_\.]{2,40}$'
			    )
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