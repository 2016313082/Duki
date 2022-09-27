<?php

class Subcategoria extends AppModel {
    public $name = 'Subcategoria';
    public $useTable = 'subcategorias';

    public $hasAndBelongsToMany = array(
	    'Productos'=>array(
	        'className' => 'Producto',
	        'joinTable' => 'productos_categorias',
	        'foreignKey' => 'subcategoria_id',
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

	/* public $hasMany = array(
		'Subcategorias'=>array(
			'className' => 'Subcategoria',
	        'joinTable' => 'productos_categorias',
	        'foreignKey' => 'id_categoria',
	        'associationForeignKey' => 'subcategoria_id'
		),
		'SubcategoriasDos'=>array(
			'className' => 'SubcategoriaDos',
	        'joinTable' => 'productos_categorias',
	        'foreignKey' => 'id_categoria',
	        'associationForeignKey' => 'subcategoria2_id'
		)
	); */
}

?>