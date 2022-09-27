<?php

class SubcategoriaDos extends AppModel {
    public $name = 'SubcategoriaDos';
    public $useTable = 'subcategorias2';

    public $hasAndBelongsToMany = array(
	    'Productos'=>array(
	        'className' => 'Producto',
	        'joinTable' => 'productos_categorias',
	        'foreignKey' => 'subcategoria2_id',
	        'associationForeignKey' => 'producto_id',
	        'unique' => true,
	        'conditions' => array(
				'Productos.activo = 1',
				'Productos.inventario > 0.5', 
				'Productos.unidad_principal IS NOT NULL',
				'Productos.precio_venta > 0',
				'Productos.conversion > 0' 
				//'Productos.inventario > Productos.stock_minimo'
			),
	        'fields' => '',
	        'order' => 'Productos.nombre ASC',
	        'limit' => '',
	        'offset' => '',
	        'finderQuery' => '',
	        'with' => 'productos_categorias'
	    ),
	);
	
	/* public $belongsTo = array(
		'Subcategorias' => array(
			'className' => 'Subcategoria',
			'foreignKey' => 'id_subcategoria',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); */
}

?>