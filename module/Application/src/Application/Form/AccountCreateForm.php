<?php

namespace Application\Form;

use Zend\Form\Form;

class AccountCreateForm
extends Form
{
	public function __construct ($name = null)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'username'
				, 'attributes' => array
				(
			         'type' => 'email'
			        , 'required' => 'required'
			        , 'minlength' => '3'
			    )
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'password'
				, 'attributes' => array
				(
			        'type' => 'password',
			        'required' => 'required',
			        'minlength' => '6',
			        'maxlength' => '100'
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