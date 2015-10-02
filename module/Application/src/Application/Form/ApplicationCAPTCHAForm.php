<?php

namespace Application\Form;

use Zend\Form\Form;

class ApplicationCAPTCHAForm
extends Form
{
	public function __construct ($name = null)
	{
		parent::__construct($name);
	}

	protected function addCAPTCHA ( )
	{
		$this->add
		(
			array 
			(
                'type' => 'Zend\Form\Element\Captcha',
                'name' => 'captcha',
                'options' => array
                (
                    'label' => 'Please verify you are human.',
                    'captcha' => array
                    (
                        'class' => 'Image',
                        'font' => 'data/fonts/arial.ttf',
		                'width' => 250,
		                'height' => 100,
		                'dotNoiseLevel' => 40,
		                'lineNoiseLevel' => 3
                    ),
				)
			)
		)
		;
	}
}