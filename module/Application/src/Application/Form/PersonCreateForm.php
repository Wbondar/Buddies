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
				, 'attributes' => array
				(
			         'type' => 'text'
			        , 'required' => 'required'
			        , 'pattern'  => '^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$'
			    )
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'nameLast'
				, 'attributes' => array
				(
			        'type' => 'text',
			        'required' => 'required',
			        'pattern'  => '^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$'
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