<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'RequestHandler',
		'Auth' => array(
			'authenticate'=> array(
				'Form'=>array(
					'fields'=>array('username'=>'email')
				)
			),
		),
		'Cookie'
	);
	function beforefilter(){
        //$this->apiUrl = "https://betaerp.metusgroup.com/api/index.php/";//URL para apuntar a ambiente pruebas
		$this->apiUrl = "https://erp.metusgroup.com/api/index.php/";//URL para apuntar a ambiente productivo
		$this->apiKey = "oTH0Yj820E9TFKk7nwxsm5UySQ4n6Rh2"; //API KEY para el permiso del usuario 

		$this->clienteDuki = 233; //Id de cliente DUKI
		$this->almacenDuki = 5; //Id del almacén en donde se harán todas las bajas
		$this->ctatc = 5; //Id de cuenta de banco en donde se realizan los depósitos 
		$this->paiment_id_cc = 6; //Id correspondiente al diccionario de Modo de pago para tarjeta de crédito
		$this->paiment_id_cash = 4; //Id correspondiente al diccionario de Modo de pago para efectivo
		$this->paiment_id_transfer = 2; //Id correspondiente al diccionario de Modo de pago para TEF

		$this->encryptKey = hex2bin('0517BDAF78F83CE5589AA78900AEBA'); 
        //$this->credenciales = ['login'=>'apiws','password'=>'M3tus.2021','entity'=>'1'];
        //$this->apiUrl = "https://betaerp.metusgroup.com/api/index.php/";//Productivo
		
		$this->Auth->allow('display');
		$this->loadModel('Pedido');
		$this->set(
			'carrito',
			$this->Pedido->find(
				'first',
				array(
					'conditions'=>array(
						'Pedido.user_id'=>$this->Session->read('Auth.User.id'),
						'Pedido.status'=>1
					)
				)
			)
		);
    }
}
?>
