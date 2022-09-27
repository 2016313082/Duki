<?php
class Pedido extends AppModel {
	var $name = 'Pedido';
	
	public $displayField = 'id';

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CP' => array(
			'className' => 'Cp',
			'foreignKey' => 'cp_id_envio',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	public $hasAndBelongsToMany = array(
	    'Productos'=>array(
	        'className' => 'Producto',
	        'joinTable' => 'pedidos_productos',
	        'foreignKey' => 'pedido_id',
	        'associationForeignKey' => 'producto_id',
	        'unique' => true,
	        'conditions' => '',
	        'fields' => '',
	        'order' => 'Productos.sku',
	        'limit' => '',
	        'offset' => '',
	        'finderQuery' => '',
	        'with' => 'pedidos_productos'
	    ),
	);
}
?>