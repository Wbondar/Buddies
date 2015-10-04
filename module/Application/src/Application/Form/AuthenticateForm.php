<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class AuthenticateForm
extends ApplicationCAPTCHAForm
{
	private static $CUSTOM_INPUTFILTER;

	private static function getCustomInputFilter ( )
	{
		if (static::$CUSTOM_INPUTFILTER == null)
		{            
			$inputFilter = new InputFilter();

			$inputFilter->add
			(
				array
				(
					'name'     => 'username',
					'required' => true,
					'filters'  => array
					(
						array
						(
							'name' => 'StripTags'
						),
						array
						(
							'name' => 'StringTrim'
						),
					),
					'validators' => array
					(
						array
						(
							'name'    => 'EmailAddress',
							'options' => array
							(
							),
						),
					),
				)
			);
			$inputFilter->add
			(
				array
				(
					'name'     => 'password',
					'required' => true,
					'filters'  => array
					(
						array
						(
							'name' => 'StripTags'
						),
						array
						(
							'name' => 'StringTrim'
						),
					),
					'validators' => array
					(
						array
						(
							'name'    => 'StringLength',
							'options' => array
							(
								'encoding' => 'UTF-8',
								'min'      => 8,
								'max'      => 100,
							),
						),
					),
				)
			);
			static::$CUSTOM_INPUTFILTER = $inputFilter;
		}
		return static::$CUSTOM_INPUTFILTER;
	}

	public function __construct ($name = null)
	{
		parent::__construct($name);
		$this->add
		(
			array 
			(
				  'name' => 'username'
				/*, 'type' => 'Zend\Form\Element\Email'
				, 'attributes' => array
				(
			         'type' => 'email'
			        , 'required' => 'required'
			        , 'minlength' => '3'
			    )*/
			    , 'options' => array 
			    (
			    	'label' => 'E-mail address.'
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
			        'minlength' => '8',
			        'maxlength' => '100'
			    )
			    , 'options' => array 
			    (
			    	'label' => 'Password.'
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
					'value' => 'Log in'
				)
			)
		)
		;
		$this->addCAPTCHA( );
		$this->setInputFilter(static::getCustomInputFilter( ));
	}
}