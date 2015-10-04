<?php

namespace Application\Form;

use Zend\Form\Form;

class PhoneNumberCreateForm
extends Form
{
	public function __construct ($name = null)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'value'
				, 'attributes' => array
				(
			          'type' => 'tel'
			        , 'required' => 'required'
			        , 'pattern'  => '\d{3}[\-]\d{3}[\-]\d{3}'
			        , 'placeholder' => '###-###-###'
			    )
			    , 'options' => array 
			    (
			    	'label' => 'Phone number.'
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
					'value' => 'Add'
				)
			)
		)
		;
	}
}