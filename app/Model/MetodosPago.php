<?php
class MetodosPago extends AppModel {
	var $name = 'MetodosPago';
	
	public $displayField = 'numero_tarjeta';

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>