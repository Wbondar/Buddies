<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class EMailAddressCreateForm
extends Form
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
					'name'     => 'value',
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
				  'name' => 'value'
				/*, 'type' => 'Zend\Form\Element\Email'*/
				, 'attributes' => array
				(
					/*'type' => 'email'*/
			          'required' => 'required'
			        , 'placeholder' => 'example@example.com'
			    )
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
				  'name' => 'submit'
				, 'type' => 'submit'
				, 'attributes' => array 
				(
					'value' => 'Add'
				)
			)
		)
		;
		$this->setInputFilter(static::getCustomInputFilter( ));
	}
}