<?php
class User extends AppModel {
	var $name = 'User';
	
	public $displayField = 'nombre';

	public $hasMany = array(
		'Direcciones' => array(
			'className' => 'Direccion',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MetodosPago' => array(
			'className' => 'MetodosPago',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Pedidos' => array(
			'className' => 'Pedido',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PedidosRealizados' => array(
			'className' => 'Pedido',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => array('PedidosRealizados.status > 1'),
			'fields' => 'COUNT(*)',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT COUNT(*), `PedidosRealizados`.`user_id` FROM `metus973_duki`.`pedidos` AS `PedidosRealizados` inner join users on users.id = PedidosRealizados.user_id  WHERE `PedidosRealizados`.`status` > 1 and users.interno = 0 group by user_id',
			'counterQuery' => ''
		),
		'CarritosAbandonados' => array(
			'className' => 'Pedido',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => 'CarritosAbandonados.status = 1',
			'fields' => 'COUNT(*)',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'SELECT COUNT(*), `CarritosAbandonados`.`user_id` FROM `metus973_duki`.`pedidos` AS `CarritosAbandonados` inner join users on users.id = CarritosAbandonados.user_id WHERE `CarritosAbandonados`.`status` = 1 AND users.interno = 0 group by user_id',
			'counterQuery' => ''
		)
	);
}
?>