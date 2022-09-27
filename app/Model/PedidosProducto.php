<?php
class PedidosProducto extends AppModel {
	var $name = 'PedidosProducto';

	public $belongsTo = array(
		'Producto' => array(
			'className' => 'Producto',
			'foreignKey' => 'producto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
?>