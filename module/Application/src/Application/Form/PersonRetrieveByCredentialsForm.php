<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

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
			    , 'options' => array 
			    (
			    	'label' => 'Search query.'
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
				, 'attributes' => array 
				(
					'value' => 'Search'
				) 
			)
		)
		;
	}
}