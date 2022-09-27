<?php
class Producto extends AppModel {
	var $name = 'Producto';
	//public $virtualFields = array('nombre_compuesto'=>'CONCAT(Producto.iniciales,"-",Producto.nombre)');
	public $hasAndBelongsToMany = array(
	    'Categorias'=>array(
	        'className' => 'Producto',
	        'joinTable' => 'productos_categorias',
	        'foreignKey' => 'producto_id',
	        'associationForeignKey' => 'categoria_id',
	        'unique' => true,
	        'conditions' => '',
	        'fields' => '',
	        'order' => '',
	        'limit' => '',
	        'offset' => '',
	        'finderQuery' => '',
	        'with' => 'productos_categorias'
	    ),
		'Pedidos'=>array(
	        'className' => 'Producto',
	        'joinTable' => 'pedidos_productos',
	        'foreignKey' => 'producto_id',
	        'associationForeignKey' => 'pedido_id',
	        'unique' => true,
	        'conditions' => '',
	        'fields' => '',
	        'order' => '',
	        'limit' => '',
	        'offset' => '',
	        'finderQuery' => '',
	        'with' => 'pedidos_productos'
	    ),
	);
}

?>