<?php

namespace Application\Form;

use Zend\Form\Form;

class EMailAddressCreateForm
extends Form
{
	public function __construct ($name)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'value'
				, 'attributes' => array
				(
			          'type' => 'email'
			        , 'required' => 'required'
			        , 'placeholder' => 'example@example.com'
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