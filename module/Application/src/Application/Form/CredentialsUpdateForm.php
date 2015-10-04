<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CredentialsUpdateForm
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
					'name'     => 'nameFirst',
					'required' => true,
					'filters'  => array
					(
						array
						(
							'name' => '\Zend\Filter\UpperCaseWords',
							'options' => array
							(
								'encoding' => 'UTF-8',
							),
						),
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
								'min'      => 3,
								'max'      => 100,
							),
						),
					),
				)
			);

			$inputFilter->add
			(
				array
				(
					'name'     => 'nameLast',
					'required' => true,
					'filters'  => array
					(
						array
						(
							'name' => '\Zend\Filter\UpperCaseWords',
							'options' => array
							(
								'encoding' => 'UTF-8',
							),
						),
						array
						(
							'name' => 'StripTags',
						),
						array
						(
							'name' => 'StringTrim',
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
								'min'      => 3,
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
				  'name' => 'nameFirst'
				  , 'options' => array 
				  (
				  	'label' => 'First name.'
				  )
			)
		)
		;
		$this->add
		(
			array 
			(
				  'name' => 'nameLast'
				  , 'options' => array 
				  (
				  	'label' => 'Last name.'
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
					'value' => 'Update'
				)
			)
		)
		;
		$this->setInputFilter(static::getCustomInputFilter( ));
	}
}