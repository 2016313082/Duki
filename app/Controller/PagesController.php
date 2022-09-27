<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function display() {

		$this->loadModel('Banner');
		$this->set('banners',$this->Banner->find('all'));

		//Buscar productos para las categorias de HOME
		$this->loadModel('Producto');
		$this->Producto->Behaviors->load('Containable');
		$this->set(
			'semana',
			$this->Producto->query('SELECT * FROM productos inner join productos_categorias on productos.id = productos_categorias.producto_id where productos_categorias.categoria_id = 112 AND productos.precio_venta > 0 AND inventario > 0.5')
		);

		$this->set(
			'mercado',
			$this->Producto->query('SELECT * FROM productos inner join productos_categorias on productos.id = productos_categorias.producto_id where productos_categorias.categoria_id = 103 AND productos.precio_venta > 0 AND inventario > 0.5')
		);

		$this->set(
			'nuevos',
			$this->Producto->query('SELECT * FROM productos inner join productos_categorias on productos.id = productos_categorias.producto_id where productos_categorias.categoria_id = 104 AND productos.precio_venta > 0 AND inventario > 0.5')
		);
		
		$this->set(
			'destacados',
			$this->Producto->query('SELECT * FROM productos inner join productos_categorias on productos.id = productos_categorias.producto_id where productos_categorias.categoria_id = 105 AND productos.precio_venta > 0 AND inventario > 0.5')
		);
		 
		//aqui se creaba la cookie
		if($this->Session->read('Auth.User.id')){
			$pedidos['num_rows'] = $this->Pedido->find('count',
						array(
								'conditions'=>array(
										'user_id'=>$this->Session->read('Auth.User.id'),
										'status'=>1
								)
						));
			$pedidos['campos'] = $this->Pedido->find('all',
						array(
								'conditions'=>array(
										'user_id'=>$this->Session->read('Auth.User.id'),
										'status'=>1
								)
						));
			if(intval($pedidos['num_rows']) > 0){
				$id_pedido = $pedidos['campos'][0]['Pedido']['id'];
			}else{
				$pedido = array(
						'user_id' => $this->Session->read('Auth.User.id'),
						'status' => 1,
				);
				$this->Pedido->save($pedido);
				$id_pedido = $this->Pedido->id;
			} 
		}

		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
