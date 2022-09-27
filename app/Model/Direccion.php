<?php
class Direccion extends AppModel {
	var $name = 'Direccion';
	
	public $displayField = 'nombre';

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