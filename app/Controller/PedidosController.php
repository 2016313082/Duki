<?php
class PedidosController extends AppController {
	const AUTORIZADO = 1;
    const RECHAZADO = 0;
	protected $_method;

	public $helpers = array('Js');
	var $name = 'Pedidos';

	function beforeFilter(){
		$this->_method = 'AES-128-CBC';
		parent::beforeFilter();
		$this->Auth->allow(array('addCarrito','resumen','resumenDetalle','deleteProduct','updateItem','clear','validarCupon','confirm_entrega','removeCarritoRow','updateStatus','prueba','recargar_datos','validaCarrito','traer_producto','pagoProcesado','traer_producto_2','prueba'));
	}
	
        
	
	public function traer_producto(){
		//pp = pedido producto
		$id_pp = $this->request->data('id_producto');
		$this->loadModel('PedidosProducto');
		$obj = $this->PedidosProducto->find(
				'all',
				array(
					'conditions'=>array(
						'PedidosProducto.id'=>$id_pp
					),
				)
		);
		$this->response->type('json');
		$this->response->body(json_encode($obj[0]));
		return $this->response;
	}
	
	
	
	public function traer_producto_2(){
		$id_pp = $this->request->data('id_producto');
		$id_ped = $this->request->data('id_pedido');
		$this->loadModel('PedidosProducto');
		$obj = $this->PedidosProducto->query('SELECT * FROM metus973_duki.pedidos_productos as PedidosProducto inner join productos_categorias as ProductosCategoria on PedidosProducto.producto_id = ProductosCategoria.producto_id inner join productos as Producto on PedidosProducto.producto_id = Producto.id where PedidosProducto.producto_id = ? AND PedidosProducto.pedido_id = ?',array($id_pp,$id_ped	));
		/* $obj = $this->PedidosProducto->find(
				'all',
				array(
					'conditions'=>array(
						'PedidosProducto.producto_id'=>$id_pp,
						'PedidosProducto.pedido_id'=>$id_ped
					),
				)
		);   */
		$this->response->type('json');
		$this->response->body(json_encode($obj[0]));
		return $this->response;
	}
		
	public function validaCarrito(){
		if($this->Session->read('Auth.User.id')){
			$obj['isLogged'] = true;
		}else{
			$obj['isLogged'] = false;
		}

		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}
	
	/* public function prueba(){
		$obj = $this->Pedido->query('SELECT productos.nombre ,cantidad_enviada,cantidad_solicitada,unidad_solicitada,(monto_solicitado + iva_solicitado + ieps_solicitado) as precio_final, pedidos.status, CONCAT(users.nombres, " " , users.apellido_paterno) as nombre_completo ,direccion_adicional,fecha_pedido,pedidos.id as id_pedido from `productos` INNER JOIN pedidos_productos on productos.id = pedidos_productos.producto_idINNER JOIN pedidos on pedidos.id = pedidos_productos.pedido_id INNER JOIN users on pedidos.user_id = users.id order by user_id desc');
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	} */
		
	public function recargar_datos(){
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
		$obj = $this->Pedido->find('first',array('conditions'=>array('Pedido.id'=>$id_pedido,'Pedido.status'=>1)));
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	public function addCarrito(){ 
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
		$this->loadModel('Producto');
		$this->Producto->Behaviors->load('Containable');
		$producto = $this->Producto->find(
			'first',
			array(
				'conditions'=>array(
				'Producto.id'=>$this->request->data['id']
				),
				'contain'=>false,
				'fields'=>array(
					'id','precio_venta','unidad_principal','unidad_secundaria','conversion','tasa_iva','tasa_ieps'
				)
			)
		);

		$peso_real = 0;
		$iva_solicitado = 0;
		$ieps_solicitado = 0;
		if ($producto['Producto']['unidad_principal']!=$this->request->data['unidad']){
			$peso_real = $this->convertir($producto['Producto']['precio_venta'],$producto['Producto']['conversion'])*$this->request->data['cantidad'];
		}else{
			$peso_real = $this->request->data['cantidad']*$producto['Producto']['precio_venta'];
		}
		if($producto['Producto']['tasa_iva']!=0){
			$iva_solicitado = $peso_real*($producto['Producto']['tasa_iva']/100);
		}
		if($producto['Producto']['tasa_ieps']!=0){
			$ieps_solicitado = $peso_real*($producto['Producto']['tasa_ieps']/100);
		}
		
		if($this->request->data['id'] == 2180){
			if($this->request->data['notas'] == 0){
				$cookie_producto = "tipo_cerveza_uno";
				//$obj['id'] =  $obj[0]['cps']['id'];
				setcookie($cookie_producto,$this->request->data['notas'] , time() + (60*60*24*365), "/");
			}else if($this->request->data['notas'] == 1){
				$cookie_producto = "tipo_cerveza_uno";
				//$obj['id'] =  $obj[0]['cps']['id'];
				setcookie($cookie_producto,$this->request->data['notas'] , time() + (60*60*24*365), "/");
			}
			$cookie_producto = "producto_id_uno";
			//$obj['id'] =  $obj[0]['cps']['id'];
			setcookie($cookie_producto,$this->request->data['id'] , time() + (60*60*24*365), "/");
		}else if($this->request->data['id'] == 2179){
			if($this->request->data['notas'] == 0){
				$cookie_producto = "tipo_cerveza_dos";
				//$obj['id'] =  $obj[0]['cps']['id'];
				setcookie($cookie_producto,$this->request->data['notas'] , time() + (60*60*24*365), "/");
			}else if($this->request->data['notas'] == 1){
				$cookie_producto = "tipo_cerveza_dos";
				//$obj['id'] =  $obj[0]['cps']['id'];
				setcookie($cookie_producto,$this->request->data['notas'] , time() + (60*60*24*365), "/");
			}
			$cookie_producto = "producto_id_dos";
			//$obj['id'] =  $obj[0]['cps']['id'];
			setcookie($cookie_producto,$this->request->data['id'] , time() + (60*60*24*365), "/");
		}

		$carrito = array(
			'pedido_id' => $id_pedido,
			'producto_id' => $this->request->data['id'],
			'cantidad_solicitada'=>$this->request->data['cantidad'],
			'unidad_solicitada'=>$this->request->data['unidad'],
			'monto_solicitado'=>$peso_real,
			'iva_solicitado'=>$iva_solicitado,
			'observaciones'=>$this->request->data['notas'],
			'ieps_solicitado'=>$ieps_solicitado,
		);
		$this->loadModel('PedidosProducto');
		$pedidoProducto = $this->PedidosProducto->find(
				'count',
				array(
					'conditions'=>array(
						'PedidosProducto.producto_id'=>$this->request->data['id'],
						'PedidosProducto.pedido_id'=>$id_pedido
					),
				)
		);
		if($pedidoProducto > 0){
			$pedido['existencia'] = true;
		}else{
			if($this->PedidosProducto->save($carrito)){
				$pedido = $this->Pedido->read(null,$id_pedido);
				$pedido['existencia'] = false;
			} 
		}
	 
		$this->response->type('json');
		$this->response->body(json_encode($pedido));
		return $this->response;
	}

	public function convertir($precio = null, $conversion = null){
		return $precio * $conversion;
	}

	public function removeCarritoRow(){
	//ver cual es la diferencia entre esta funcion y la que ya existia de elimiar productos 
		$this->loadModel('PedidosProducto');
		$pedido_id = $this->PedidosProducto->read(null,$this->request->data['id']);

		$this->Pedido->query("DELETE FROM pedidos_productos WHERE id = ".$this->request->data['id']);

		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$pedido_id['PedidosProducto']['pedido_id']
				),
			)
		);
		$total = 0;
		$cantidad = 0;
		foreach($pedido['Productos'] as $producto):
			$total += $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'];
			$cantidad ++;
		endforeach;

		$respuesta['respuesta']=1;
		$respuesta['total']=$total;
		$respuesta['cantidad']=$cantidad;
		$respuesta['Pedido'] =  $pedido;
		header('Content-Type: application/json');
		echo json_encode($respuesta);
		exit(); 
	}


	public function updateItem(){
		$this->loadModel('PedidosProducto');
		$pp = $this->PedidosProducto->read(null,$this->request->data['PedidosProducto']['id']);

		$this->loadModel('Producto');
		$this->Producto->Behaviors->load('Containable');
		$producto = $this->Producto->find(
			'first',
			array(
				'conditions'=>array(
					'Producto.id'=>$pp['PedidosProducto']['producto_id']
				),
				'contain'=>false,
				'fields'=>array(
					'id','precio_venta','unidad_principal','unidad_secundaria','conversion'
				)
			)
		);

		$peso_real = 0;
		if ($producto['unidad_principal']!=$this->request->data['Pedido']['unidad']){
			$peso_real = $this->convertir($producto['precio_venta'],$producto['conversion'])*$this->request->data['PedidosProducto']['cantidad'];
		}else{
			$peso_real = $this->request->data['PedidosProducto']['cantidad']*$producto['precio_venta'];
		}

		$carrito = array(
			'id'=>$this->request->data['PedidosProducto']['id'],
			'cantidad_solicitada'=>$this->request->data['PedidosProducto']['cantidad'],
			'unidad_solicitada'=>$this->request->data['Pedido']['unidad'],
			'monto_solicitado'=>$peso_real
		);
		if($this->PedidosProducto->save($carrito)){
			$obj['resultado'] = true;
		}else{
			$obj['resultado'] = false;
		}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	public function resumen(){
		if($this->Session->read('Auth.User.interno')==false){
			$this->loadModel('Cp');
			$cps = $this->Cp->find('all');
			$cp_array = array();
			foreach($cps as $cp):
				$cp_array[$cp['Cp']['id']] = $cp['Cp']['colonia'].", CP ".$cp['Cp']['cp'].", ".$cp['Cp']['municipio'].", ".$cp['Cp']['ciudad'].", ".$cp['Cp']['estado'];
			endforeach;
			$this->set('cps',$cp_array);
			$this->loadModel('Producto');
			$this->Producto->Behaviors->load('Containable');
			$this->set(
			'antojos',
				$this->Producto->query('SELECT * FROM productos inner join productos_categorias on productos.id = productos_categorias.producto_id where productos_categorias.categoria_id = 122 AND productos.precio_venta > 0 AND productos.inventario > 3 AND productos.activo = 1')
			);
			if($this->Session->read('Auth.User.id')!=""){
				$this->loadModel('Direccion');
			$this->set(
					'direcciones',
						$this->Direccion->find(
							'list',
							array(
								'conditions'=>array(
									'Direccion.user_id'=>$this->Session->read('Auth.User.id')
								)
							)
						)
				);
			}
			$this->render('/Pedidos/resumen');
		}else{
			$this->Auth->logout();
			$this->redirect(array("controller" => "users", "action" => "login"));
			$this->Session->setFlash(__('No es posible acceder a esta sección', true), 'default' ,array('class'=>'error'));
		}
	}

	public function resumenDetalle(){
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
		if($this->Session->read('Auth.User.interno')==false){
			$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$id_pedido
				)
			)
			);
			$obj['carrito'] = $pedido;
			$this->loadModel('Cupon');
			$obj['cupon'] = $this->Cupon->findFirstByCupon($pedido['Pedido']['cupon']);

		}else{
			$this->Auth->logout();
			$this->Session->setFlash(__('No es posible acceder a esta sección', true), 'default' ,array('class'=>'error'));
			$obj = 'acceso denegado';
		}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}
	
	public function updateProducto(){
		$this->loadModel('PedidosProducto');
		if($this->PedidosProducto->save($this->request->data)){
			$obj['resultado'] = true;
		}else{
			$obj['resultado'] = false;
		} 
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	} 
	
	public function setDireccion(){
		$this->loadModel('Direccion');
		$direccion = $this->Direccion->find('first',array('conditions'=>array('Direccion.id'=>$this->request->data['direccion_id'])));

		$pedido = array(
			'calle_envio' => $direccion['Direccion']['calle'],
			'numero_interior_envio' => $direccion['Direccion']['numero_interior'],
			'numero_exterior_envio' => $direccion['Direccion']['numero_exterior'],
			'cp_id_envio' => $direccion['Direccion']['cp_id'],
			'id' => $this->request->data['pedido_id']
		);
		if($this->Pedido->save($pedido)){
			$obj = true;
		}else{
			$obj = false;
		}
		//$this->Pedido->save($pedido);
		//header('Content-Type: application/json');
		//exit();
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	public function validarCupon(){
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
		if($this->Session->read('Auth.User.interno')==false){
			/*$this->response->type('json');
			$this->response->body(json_encode($obj));
			return $this->response;*/

			$this->loadModel('Cupon');
			$objeto = $this->request->data['Pedido'];
			$cupon = $this->Cupon->findFirstByCupon($objeto['cupon']);
			if(!empty($cupon)){
				if ($cupon['Cupon']['monto_minimo_compra']==""){//El cupón no tiene mínimo de compra
					$pedido = array(
						'id'=>$id_pedido,
						'cupon'=>$objeto['cupon']
					);
				}else{ //El cupón necesita un mínimo de compra
					$this->loadModel('Pedido');
					$this->loadModel('PedidosProducto');
					$pedido = $this->PedidosProducto->find(
						'all',
						array(
							'contain'=>false,
							'conditions'=>array(
								'PedidosProducto.pedido_id'=>$id_pedido
							)
						)
				);
					if(!$this->Session->read('Auth.User.id')){
						$obj['validaCupon1'] = false;
						$obj['mensaje1'] = 'No hay sessión activa'; 
						$this->response->type('json');
						$this->response->body(json_encode($obj));
						return $this->response;
					}
					
					if($cupon['Cupon']['unique'] == 1 && $cupon['Cupon']['veces_usado'] > 0){
						$obj['validaCupon1'] = false;
						$obj['mensaje1'] = 'Este cupón ya fue utilizado'; 
						$this->response->type('json');
						$this->response->body(json_encode($obj));
						return $this->response;
					}
					//PENDIENTE -> if de validacion
					if($cupon['Cupon']['fecha_final'] > date("Y-m-d H:i:s")){
						$total = 0;
						foreach($pedido as $ped){
								//$total = $total + $ped['monto_solicitado'];
								$total = $total + $ped['PedidosProducto']['monto_solicitado'] + $ped['PedidosProducto']['iva_solicitado'] + $ped['PedidosProducto']['ieps_solicitado']; 
						}
						if($total>$cupon['Cupon']['monto_minimo_compra']){//Cumple con el mínimo de compra
								$pedido = array(
										'id'=>$id_pedido,
										'cupon'=>$this->request->data['Pedido']['cupon']
								);
						}else{
								$obj['validaCupon2'] = false;
								$obj['mensaje'] = "Tu cupón necesita un mínimo de compra de $".number_format($cupon['Cupon']['monto_minimo_compra'],2)." pesos";
								$this->response->type('json');
								$this->response->body(json_encode($obj));
								return $this->response;
						}
					}else{
						$obj['validaCupon3'] = false;
						$obj['mensaje'] = 'tu cupón ha expirado';
						$this->response->type('json');
						$this->response->body(json_encode($obj));
						return $this->response;
					}
					
				}
                                
				if($this->Pedido->save($pedido)){
					$obj['validaCupon2'] = true;
					$obj['mensaje'] = "Tu cupón se ha aplicado a tu carrito";
					$this->response->type('json');
					$this->response->body(json_encode($obj));
					return $this->response;
				}
			}else{
				$obj['validaCupon1'] = false;
				$obj['mensaje1'] = "Tu cupón es inválido";
				$this->response->type('json');
				$this->response->body(json_encode($obj));
				return $this->response;
			}
		}else{
			$obj = 'acceso denegado';
		}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	function deleteProduct($id = null) {
		
		$id = $this->request->data('id');
		if (!$id) {
			$this->Session->setFlash(__('Registro invalido', true));
		}
		$this->loadModel('PedidosProducto');
		if ($this->PedidosProducto->delete($id)) {
			$obj['resultado'] = true;
		}else{
			$obj['resultado'] = false;
		}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	function clear() {
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
		$this->Pedido->query("DELETE FROM pedidos_productos WHERE pedido_id = '".$id_pedido."'");
		$this->Session->setFlash("Tu carrito se encuentra vacío", 'default' ,array('class'=>'success'));
		$this->redirect(array('action'=>'resumen','controller'=>'pedidos'));
	}
	
	public function pagoProcesado(){
		//$respuestaWS = $this->request->data['response'];
		$respuestaWS = "+n6S6nm+7U2jg8ToGK+v41MoigSu4bdJSn83n9cUdWyBIm8eouPYJtT44IGQNfkmnbuaqN1CiY9kna62i1vdXaMbcAG5hDkY9kN1Hc1oD2dDsmI8MZ88XKr2WKIkbQE+2gY6UuPFVi0M0sg/bUhhsonSDHZU/UDwsow+0mV2/trn3eBXVUniLp/LbqeSwSYjN/dpsQr8vrlthv5Mg7zjPOM6RvBssgidd4Zb8mEeB/w=";
		$apiKey = "663639e3bbd79831";
		
		$responseEncode = $this->desencriptar_php72($respuestaWS, $apiKey);
		$obj = json_decode($responseEncode,true);
		//$respuesta = json_decode($responseEncode);
		//$obj = $this->Session->read('Auth');
		//if($responseEncode['autorizado']){
			
		//}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

	function pagar(){
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
		$this->loadModel('Producto');

		if($this->request->is('post')){ //Guardar el pedido
			$this->loadModel('Cp');
			$cp = $this->Cp->read(null,$this->request->data['Pedido']['cp_id']);
			$pedido = array(
				'id'=>$id_pedido,
				'nombre_pedido'=>$this->request->data['Pedido']['nombre_pedido'],
				'email_contacto'=>$this->request->data['Pedido']['email_contacto'],
				'telefono1_contacto'=>$this->request->data['Pedido']['telefono1_contacto'],
				'telefono2_contacto'=>$this->request->data['Pedido']['telefono2_contacto'],
				'calle_envio'=>$this->request->data['Pedido']['calle_envio'],
				'numero_exterior_envio'=>$this->request->data['Pedido']['numero_exterior_envio'],
				'numero_interior_envio'=>$this->request->data['Pedido']['numero_interior_envio'],
				'direccion_adicional'=>$cp['Cp']['colonia'].", CP ".$cp['Cp']['cp'].", ".$cp['Cp']['municipio'].", ".$cp['Cp']['ciudad'].", ".$cp['Cp']['estado'],
				'notas_adicionales'=>$this->request->data['Pedido']['notas_adicionales'],
				'fecha_pedido'=>date('Y-m-d H:i:s'),
				'horario_entrega'=>$this->request->data['Pedido']['horario_entrega']
			);
			//guarda en la tabla de direcciones 
			$this->loadModel('Direccion');
			$cont_direcciones = $this->Direccion->find('count',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
			if($cont_direcciones <= 3){
				$direccion = array(
					'user_id'=>$this->Session->read('Auth.User.id'),
					'nombre'=>$this->request->data['Pedido']['calle_envio'],
					'calle'=>$this->request->data['Pedido']['calle_envio'],
					'numero_exterior'=>$this->request->data['Pedido']['numero_exterior_envio'],
					'numero_interior'=>$this->request->data['Pedido']['numero_interior_envio'],
					'cp'=>$cp['Cp']['cp'],
					'colonia'=>$cp['Cp']['colonia'],
					'municipio'=>$cp['Cp']['municipio'],
					'ciudad'=>$cp['Cp']['ciudad'],
					'estado'=>$cp['Cp']['estado'],
					'cp_id'=>$this->request->data['Pedido']['cp_id'],
					'privada'=>$this->request->data['Pedido']['privada']
				);
				$this->Direccion->save($direccion);
			}
			/* 
				Estatus de pedidos
				1= Carrito
				2= Pedido Solicitado
				3= Pedido Aprobado por Duki
				4= Pedido Surtido
				5= Pedido Enviado
				6= Pedido Finalizado
				7= Pedido Cancelado
			*/
			switch($this->request->data['Pedido']['metodo_pago_id']){
				case(1): //Pago en Efectivo
					$pedido['forma_pago'] = 1;
					$pedido['status'] = 2;
				break;
				case(2): //Pago con Transferencia
					$pedido['forma_pago'] = 2;
					$pedido['status'] = 2;
				break;
				case(3): //link de pago
					$pedido['forma_pago'] = 3;
					$pedido['status'] = 2;
				break;
				default: 
					$this->LoadModel('MetodosPago');
					$this->MetodosPago->Behaviors->load('Containable');
					$mp = $this->MetodosPago->find(
						'first',
						array(
							'contain'=>false,
							'conditions'=>array(
								'MetodosPago.id'=>$this->request->data['Pedido']['metodo_pago_id']
							)
						)
					);

					App::import('Controller', 'MetodosPagos'); 
					$metodosPagos = new MetodosPagosController;
					//Validamos que el CVV concuerde
					if ($metodosPagos->decrypt($mp['MetodosPago']['cvv'],$this->encryptKey,true)==$this->request->data['Pedido']['cvv']>0){
						$pedido['forma_pago'] = $this->request->data['Pedido']['metodo_pago_id']; 
						$pedido['status'] = 3;
					}else{
						$this->Session->setFlash("Tu CVV no concuerda con tu método de pago registrado", 'default' ,array('class'=>'error'));
						$this->redirect(array('action'=>'pagar','controller'=>'pedidos'));
					}
				break;
			}
			if($this->Pedido->save($pedido)){

				$pedido_resumen = $this->Pedido->read(null,$pedido['id']);

				//Calcular de nuevo el total
				$subtotal = 0;
				$iva = 0;
				$total = 0;
				$descuento = 0;
				$envio = 0;
				$ieps = 0;

				foreach($pedido_resumen['Productos'] as $producto):
					$subtotal += $producto['pedidos_productos']['monto_solicitado'];
					$iva += $producto['pedidos_productos']['iva_solicitado'];
					$ieps += $producto['pedidos_productos']['ieps_solicitado'];
				endforeach;
				$total = $subtotal + $iva + $ieps;
				//Lineas para baja de paquetes 
							
					// fin de baja de paquetes 

				if($pedido_resumen['Pedido']['cupon'] != ""){
					$this->loadModel('Cupon');
					$cupon = $this->Cupon->find('first',array('conditions'=>array('Cupon.cupon'=>$pedido_resumen['Pedido']['cupon'])));
					switch($cupon['Cupon']['tipo_descuento']):
						case(2):
							$descuento = $total*($cupon['Cupon']['monto']/100);
						break;
						case(1):
							$descuento = $cupon['Cupon']['monto'];
						break;
					endswitch;
					$total = $total - $descuento;
				}

				//Revisar tipo de Entrega
				if ($pedido_resumen['Pedido']['horario_entrega']=='Pedido Express'){
					if($total <= 899){
						$envio = 69;
					}
				}else{
					if($total <= 499){
						$envio = 49;
					}
				}

				if($pedido_resumen['Pedido']['id_dolibarr']==NULL || $pedido_resumen['Pedido']['id_dolibarr']=="" ){
					$pedido_doli = $this->addPedidoDoli($pedido['id'],$envio);
				}else{
					$pedido_doli = $pedido_resumen['Pedido']['id_dolibarr'];
				}

				$pedido_comp = [
					'id'=>$pedido['id'],
					'subtotal'=>$subtotal,
					'iva'=>$iva,
					'descuento'=>$descuento,
					'envio'=>$envio,
					'id_dolibarr'=>$pedido_doli,
					'ieps' =>$ieps 
				];

				$this->Pedido->save($pedido_comp);
				$pedido_resumen = $this->Pedido->read(null,$pedido['id']);

				//AGREGAR LÍNEA DE PAGO DE ENVIO

				if (intval($pedido['forma_pago'])>3){ //Pago en tarjeta
					if($this->processPayment($pedido_doli,$pedido['forma_pago'],$this->getTotal($pedido['id']))>0){
					//if(1==1){
						$this->loadModel('Cupon');
						$pedido_resumen['cupon'] = $this->Cupon->find('all',array('conditions'=>array('Cupon.cupon'=>$pedido_resumen['Pedido']['cupon'])));
						$this->sendPedido($pedido_resumen);
						$this->Cookie->destroy('pedido');

						$this->loadModel('InventariosDoli');
						$inventarios = $this->InventariosDoli->find('all',array('conditions'=>array('InventariosDoli.fk_entrepot'=>$this->almacenDuki)));
						foreach ($inventarios as $existencia):
							$producto = array(
								'id'=>$existencia['InventariosDoli']['fk_product'],
								'inventario'=>$existencia['InventariosDoli']['reel']
							);
							$this->Producto->create();
							$this->Producto->save($producto);
						endforeach;
						$this->Session->setFlash("¡Muchas gracias por comprar en DUKI.MX. Tu pedido será revisado y lo surtiremos muy pronto. Si tenemos dudas nos comunicaremos a tus teléfonos de contacto.", 'default' ,array('class'=>'success'));
						$this->redirect(array('action'=>'home','controller'=>'pages'));
					}else{
						$this->Session->setFlash("El pago no pudo ser procesado. Por favor intenta con otro medio de pago.", 'default' ,array('class'=>'error'));
						$this->Pediddo->query("UPDATE pedidos SET id_dolibarr = NULL WHERE id = ".$pedido['id']);
						$this->set('error_pago',1);
						$this->redirect(array('action'=>'pagar','controller'=>'pedidos'));
					}
				}else{ //Pago en efectivo o transferencia
					//$this->sendPedido($pedido_resumen); 
					$this->loadModel('Cupon');
					$pedido_resumen['cupon'] = $this->Cupon->find('first',array('conditions'=>array('Cupon.cupon'=>$pedido_resumen['Pedido']['cupon'])));
				
					$this->loadModel('InventariosDoli');
					$inventarios = $this->InventariosDoli->find('all',array('conditions'=>array('InventariosDoli.fk_entrepot'=>5)));
					foreach ($inventarios as $existencia):
						 $producto = array(
							'id'=>$existencia['InventariosDoli']['fk_product'],
							'inventario'=>$existencia['InventariosDoli']['reel']
						);
						$this->Producto->create();
						$this->Producto->save($producto);
					endforeach;  
					if($pedido_resumen['cupon']){
					   $contador = $pedido_resumen['cupon']['Cupon']['veces_usado'] + 1;
					   $this->Cupon->query('UPDATE cupons set veces_usado ='.$contador.' where id = '.$pedido_resumen['cupon']['Cupon']['id']); 
                    }
					
					$this->sendPedido($pedido_resumen);
					$this->Session->setFlash("¡Muchas gracias por comprar en DUKI.MX. Tu pedido será revisado y lo surtiremos muy pronto. Si tenemos dudas nos comunicaremos a tus teléfonos de contacto.", 'default' ,array('class'=>'success'));
					$this->redirect(array('action'=>'home','controller'=>'pages'));
					/* $this->response->type('json');
					$this->response->body(json_encode($pedido_resumen));
					return $this->response; */
				}
			}else{
				$this->Session->setFlash("No pudimos guardar tu pedido. Intenta de nuevo", 'default' ,array('class'=>'error'));
				$this->redirect(array('action'=>'pagar','controller'=>'pedidos'));
			}


		}else{
			$pedido = $this->Pedido->read(null,$id_pedido);
			$this->set('carrito',$pedido);

			$this->loadModel('Cp');
			$cps = $this->Cp->find('all');
			$cp_array = array();
			foreach($cps as $cp):
				$cp_array[$cp['Cp']['id']] = $cp['Cp']['colonia'].", ".$cp['Cp']['cp'].", ".$cp['Cp']['municipio'];
			endforeach;
			$this->set('cps',$cp_array);

			$this->loadModel('MetodosPago');
			App::import('Controller', 'MetodosPagos'); 
			$metodosPagos = new MetodosPagosController;
			$this->MetodosPago->Behaviors->load('Containable');
			$tarjetas = $this->MetodosPago->find(
				'all',
				array(
					'contain'=>false,
					'conditions'=>array(
						'MetodosPago.user_id'=>$this->Session->read('Auth.User.id')
					)
				)
			);
			$tarjetas_arreglo=array(
				'1'=>'Efectivo en la entrega'
			);
			$tipos_tarjeta = [
				'MC' => 'mc.png',
				'AMEX' => 'amex.png',
				'VISA' => 'visa.png'
			];
			array_push($tarjetas_arreglo,['2'=>'Pago con Tarjeta a la entrega']);
			array_push($tarjetas_arreglo,['3'=>'Quiero recibir link de pago a mi correo']);
			foreach($tarjetas as $tarjeta){
				$texto = "<img src='../img/logo/".$tipos_tarjeta[$tarjeta['MetodosPago']['tipo']]."' style='height:15px'> Tarjeta terminación: ";
				//array_push($tarjetas_arreglo,array($tarjeta['MetodosPago']['id']=>$texto.substr($metodosPagos->decrypt($tarjeta['MetodosPago']['numero_tarjeta'],$this->encryptKey,true),12,4))) ;
			}
			//array_push($tarjetas_arreglo,['0'=>'<a class="btn btn-outline-success" data-toggle="modal" data-target="#img-tarjeta"> Pagar en linea con tarjeta</a>']);
			$this->set('tarjetas',$tarjetas_arreglo);

			$this->loadModel('Cupon');
			$this->set('cupon',$this->Cupon->findFirstByCupon($pedido['Pedido']['cupon']));
		}
	}

	public function sendPedido($pedido_resumen = null){
		$this->loadModel('Cupon');
		$pedido_resumen['cupon'] = $this->Cupon->find('all',array('conditions'=>array('Cupon.cupon'=>$pedido_resumen['Pedido']['cupon'])));
		$Email = new CakeEmail();
		$Email->config(array(
			'host' => 'mail.duki.mx',
			'port' => '587',
			'username' => 'pedidos@duki.mx',
			'password' => 'Pedidos.2021',
			'transport' => 'Smtp'
			)
		);
		$Email->template('confirmacion','orders'); //Email/view , Layouts/Email/layout
		//$Email->to(array('cesar@aigel.com.mx'));
		$Email->to(array($pedido_resumen['Pedido']['email_contacto']));
		$Email->from(array('pedidos@duki.mx'=>'Pedidos Duki.MX'));
		$Email->subject('Confirmación de solicitud de compra');
		$Email->emailFormat('html');
		$Email->viewVars(array('pedido' => $pedido_resumen));
		$Email->send();
		return true;
	}

	//Comienzan los métodos para Administradores

	public function index($status = null){
		if (!$this->Session->read('Auth.User.interno')){
			$this->redirect(array('controller'=>'pages','action'=>'home'));
		}
		$condiciones = array();
		if (isset($status)){
			$condiciones = array('Pedido.status'=>$status);
			$this->set('status',$status);
		}else{
			$condiciones = array('Pedido.status >'=>1);
		}
		$this->layout='admin';
		$this->Pedido->Behaviors->load('Containable');
		$this->set(
			'pedidos',
			$this->Pedido->find(
				'all',
				array(
					'conditions'=>$condiciones,
					'contain'=>array(
						'Productos'=>array(
							'fields'=>array(
								'id'
							)
						)
					),
					'fields'=>array(
						'id','fecha_pedido','forma_pago','horario_entrega','status','nombre_pedido','telefono1_contacto','direccion_adicional','email_contacto','notas_adicionales',
						'calle_envio','numero_interior_envio','numero_exterior_envio','subtotal','iva','ieps','descuento','envio'
					)
				)
			)
		);

	}

	public function view($id = null){
		if (!$this->Session->read('Auth.User.interno')){
			$this->redirect(array('controller'=>'pages','action'=>'home'));
		}
		$this->layout = 'admin';
		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$id
				),
				// 'contain'=>false,
				// 'fields'=>array(
				//     'id','fecha_pedido','forma_pago','horario_entrega','status','nombre_pedido','telefono1_contacto','direccion_adicional'
				// )
			)
		);
		$this->set('pedido',$pedido);

		$this->loadModel('Cupon');
		$this->set('cupon',$this->Cupon->findFirstByCupon($pedido['Pedido']['cupon']));
	}

	public function print($id = null){
		if (!$this->Session->read('Auth.User.interno')){
			$this->redirect(array('controller'=>'pages','action'=>'home'));
		}
		$this->layout = 'print';
		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$id
				),
				// 'contain'=>false,
				// 'fields'=>array(
				//     'id','fecha_pedido','forma_pago','horario_entrega','status','nombre_pedido','telefono1_contacto','direccion_adicional'
				// )
			)
		);
		$this->set('pedido',$pedido);

		$this->loadModel('Cupon');
		$this->set('cupon',$this->Cupon->findFirstByCupon($pedido['Pedido']['cupon']));
	}

	public function copiar($id = null){
		$this->Cookie->destroy('pedido');
		$id_nuevo = uniqid();
		$pedido_nuevo = array( //Creamos pedido desde 0
			'id'=>$id_nuevo,
			'status'=>1,
			'user_id'=>$this->Session->read('Auth.User.id')
		);
		if($this->Pedido->save($pedido_nuevo)){
			$this->Cookie->write('pedido',$id_nuevo);
		}

		$pedido = $this->Pedido->read(null,$id);

		//$this->set('pedido_nuevo',$pedido_nuevo);

		// //Agregar Productos al pedido
		foreach ($pedido['Productos'] as $producto){
			$peso_real = 0;
			$iva_solicitado = 0;
			if ($producto['unidad_principal']!=$producto['pedidos_productos']['unidad_solicitada']){
				$peso_real = $this->convertir($producto['precio_venta'],$producto['conversion'])*$producto['pedidos_productos']['cantidad_solicitada'];
			}else{
				$peso_real = $producto['pedidos_productos']['cantidad_solicitada']*$producto['precio_venta'];
			}
			if($producto['tasa_iva']!=0){
				$iva_solicitado = $peso_real*($producto['tasa_iva']/100);
			}

			$carrito = array(
				'pedido_id'=>$id_nuevo,
				'producto_id' => $producto['id'],
				'cantidad_solicitada'=>$producto['pedidos_productos']['cantidad_solicitada'],
				'unidad_solicitada'=>$producto['pedidos_productos']['unidad_solicitada'],
				'monto_solicitado'=>$peso_real,
				'iva_solicitado'=>$iva_solicitado,
				'observaciones'=>$producto['pedidos_productos']['observaciones']
			);
			$this->loadModel('PedidosProducto');
			$this->PedidosProducto->create();
			$this->PedidosProducto->save($carrito);
		}
		$this->Session->setFlash("¡El Pedido ha sido agregado de nuevo a tu carrito!", 'default' ,array('class'=>'success'));
		$this->redirect(array('action'=>'resumen','controller'=>'pedidos'));
	}

	public function detalle($id = null){
		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$id
				),
				// 'contain'=>false,
				// 'fields'=>array(
				//     'id','fecha_pedido','forma_pago','horario_entrega','status','nombre_pedido','telefono1_contacto','direccion_adicional'
				// )
			)
		);
		$this->set('pedido',$pedido);

		$this->loadModel('Cupon');
		$this->set('cupon',$this->Cupon->findFirstByCupon($pedido['Pedido']['cupon']));
	}

	public function updateStatus(){
		if($this->request->is('post')){
			if (isset($this->request->data['Pedido']['comentario'])){
				$comentario = $this->request->data['Pedido']['comentario'];
			}else{
				$comentario = $this->request->data['Pedido']['comentario'.($this->request->data['Pedido']['status']-1)];
			}
			$pedido = array(
				'id'=>$this->request->data['Pedido']['pedido_id'],
				'status'=>$this->request->data['Pedido']['status'],
				'comentario'.($this->request->data['Pedido']['status']-1)=>$comentario,
				'c_e_'.($this->request->data['Pedido']['status']-1)=>$this->Session->read('Auth.User.nombres'),
				'c_e_d_'.($this->request->data['Pedido']['status']-1)=>date("Y-m-d H:i:s"),
			);
			if($this->request->data['Pedido']['status'] == 4){
				$pedido['fecha_surtido'] = date("Y-m-d H:i:s");
			}
			if($this->request->data['Pedido']['status'] == 5){
				$pedido['fecha_salida_almacen'] = date("Y-m-d H:i:s");
			}
			if($this->request->data['Pedido']['status'] == 6){
				$pedido['fecha_entrega'] = date("Y-m-d H:i:s");
			}
			if($this->Pedido->save($pedido)){
				$this->Session->setFlash("¡El Pedido ha cambiado de estado!", 'default' ,array('class'=>'success'));
			}else{
				$this->Session->setFlash("¡El Pedido no pudo cambiarse de estado. Intenta de nuevo", 'default' ,array('class'=>'success'));
			}
			$this->redirect(array('action'=>'view','controller'=>'pedidos',$this->request->data['Pedido']['pedido_id']));
		}
	}

	public function confirmar_cantidad(){

		$this->loadModel('PedidosProducto');
		$this->PedidosProducto->Behaviors->load('Containable');
		$pp = $this->PedidosProducto->find(
			'first',
			array(
				'conditions'=>array(
					'PedidosProducto.id'=>$this->request->data['id']
				),
				'fields'=>array(
					'id','producto_id'
				),
				'contain'=>array(
					'Producto'=>array(
						'fields'=>array(
							'precio_venta','unidad_principal'
						)
					)
				)
			)
		);

		$registro=array(
			'id'=>$this->request->data['id'],
			'cantidad_enviada' => $this->request->data['cantidad'],
			'monto_real'=>$this->request->data['cantidad']*$pp['Producto']['precio_venta'],
			'unidad_enviada'=>$pp['Producto']['unidad_principal']
		);
		$this->loadModel('PedidosProducto');
		$salva = 0;
		if($this->PedidosProducto->save($registro)){
			$salva = 1;
		}
		header('Content-Type: application/json');
		echo json_encode($salva);
		exit(); 
	}

	public function devolver_cantidad(){ 
		$this->loadModel('PedidosProducto');
		$this->PedidosProducto->Behaviors->load('Containable');
		$pp = $this->PedidosProducto->find(
			'first',
			array(
				'conditions'=>array(
					'PedidosProducto.id'=>$this->request->data['id']
				),
				'fields'=>array(
					'id','producto_id'
				),
				'contain'=>array(
					'Producto'=>array(
						'fields'=>array(
							'precio_venta','unidad_principal'
						)
					)
				)
			)
		);

		$registro=array(
			'id'=>$this->request->data['id'],
			'cantidad_devuelta' => $this->request->data['cantidad'],
		);
		$this->loadModel('PedidosProducto');
		$salva = 0;
		if($this->PedidosProducto->save($registro)){
			$salva = 1;
		}
		header('Content-Type: application/json');
		echo json_encode($salva);
		exit(); 
	}

	public function procesarDevolucion(){ 
		if($this->Pedido->save($this->request->data)){
			$pedido = $this->Pedido->find(
				'first',
				array(
					'conditions'=>array(
						'Pedido.id'=>$this->request->data['Pedido']['id']
					)
				)
			);

			$devolucion_total = true;
			//Procesar Devolución a inventarios
			foreach($pedido['Productos'] as $producto){
				if ($producto['pedidos_productos']['cantidad_devuelta']<$producto['pedidos_productos']['cantidad_enviada']){
					$devolucion_total = false;
				}
				//Usar la misma equivalencia de productos
				$stock_mov = array(
					"product_id"        => $producto['id'],
					"warehouse_id"      => $this->almacenDuki,
					"qty"               => $producto['pedidos_productos']['cantidad_devuelta'],
					"movementcode"      =>"DUKI".$pedido['Pedido']['id'].$producto['pedidos_productos']['id'],
					"movementlabel"     =>"Devolución pedido DUKI id ".$producto['pedidos_productos']['id'],
					"dlc"               => date("Y-m-d"),
					"dluo"              => date("Y-m-d"),
				);
				$this->callAPI("POST", $this->apiKey, $this->apiUrl."stockmovements", json_encode($stock_mov));//Realizar baja de inventario
			}
		}
		$this->Session->setFlash("El pedido se ha cancelado.", 'default' ,array('class'=>'success'));
		$this->redirect(array('controller'=>'pedidos','action'=>'index'));
	}

	public function confirm_entrega($id_pedido = null){
		$this->layout = 'blank';
		$this->Pedido->Behaviors->load('Containable');
		if($this->request->is('post')){
			$pedido = $this->Pedido->find(
				'first',
				array(
					'conditions'=>array(
						'Pedido.id'=>$id_pedido
					),
					'contain'=>false,
					'fields'=>array(
						'id','id_dolibarr'
					)
				)
			);
			$this->processPayment($pedido['Pedido']['id_dolibarr'],1);
			$pp = array(
				'id'=>$pedido['Pedido']['id'],
				'fecha_pago'=>date("Y-m-d H:i:s"),
				'fecha_entrega'=> date("Y-m-d H:i:s"),
				'status'=>6
			);
			if($this->Pedido->save($pp)){
				$this->Session->setFlash("El pedido se ha registrado como entregado y pagado.", 'default' ,array('class'=>'success'));
				$this->redirect(array('controller'=>'pedidos','action'=>'confirm_entrega',$pedido['Pedido']['id']));
			}
		}else{
			$pedido = $this->Pedido->find(
				'first',
				array(
					'conditions'=>array(
						'Pedido.id'=>$id_pedido
					)
				)
			);
			$this->set('pedido',$pedido);
		}
	}

	public function addPedidoDoli($id_pedido = null, $envio = null){
		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'first',
			array(
				'conditions'=>array(
					'Pedido.id'=>$id_pedido
				)
			)
		);
		$total_pedido = 0;
		$descuento = 0;

		foreach($pedido['Productos'] as $producto){
			$total_pedido += $producto['pedidos_productos']['monto_solicitado'];
		}
		if($pedido['Pedido']['cupon'] != ""){
			$this->loadModel('Cupon');
			$this->Cupon->Behaviors->load('Containable');
			$cupon = $this->Cupon->find(
				'first',
				array(
					'conditions'=>array(
						'Cupon.cupon'=>$pedido['Pedido']['cupon']
					)
				)
			);
			switch($cupon['Cupon']['tipo_descuento']):
				case(1):
					$descuento = $total_pedido*($cupon['Cupon']['monto']/100);
				break;
				case(2):
					$descuento = $cupon['Cupon']['monto'];
				break;
			endswitch;
		}

		$facture_param = [
			"socid"=> $this->clienteDuki,
			"ref_client"=> "Pedido DUKI ".$pedido['Pedido']['id'],
			"type"=> "0",
			"total_ht"=> $total_pedido-$descuento,
			"total_tva"=> "0.00000000",
			"total_ttc"=> $total_pedido-$descuento,
			"paye"=> "1",
			"cond_reglement_code"=> "RECEP",
			"ref"=> "Pedido DUKI ".$pedido['Pedido']['id'],
			"statut"=> "1",
			"mode_reglement_id"=> "0",
			"cond_reglement_id"=> "1",
			"cond_reglement"=> "Due upon receipt",
			"modelpdf"=> "crabe",
			"entity"=> "1",
			"cond_reglement_doc"=> "Due upon receipt",
			"user_author"=> "1",
			"user_valid"=> "1",
		];
		$pedido_id = $pedido['Pedido']['id_dolibarr'];
		if($pedido['Pedido']['id_dolibarr']=="" || $pedido['Pedido']['id_dolibarr']==NULL){
			$pedido_add = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices", json_encode($facture_param));
			$pedido_id = json_decode($pedido_add, true);
		}
			foreach($pedido['Productos'] as $producto){
				//Usar la misma equivalencia de productos
				$peso_real = 0;
				if ($producto['pedidos_productos']['unidad_solicitada']!=$producto['unidad_principal']){
					$peso_real = $producto['conversion']*$producto['pedidos_productos']['cantidad_solicitada'];
				}else{
					$peso_real = $producto['pedidos_productos']['cantidad_solicitada'];
				}

				$linea = array(
					"desc"          =>  $producto['nombre'], 
					"subprice"      =>  $producto['precio_venta'], 
					"qty"           =>  $peso_real,
					"tva_tx"        =>  $producto['tasa_iva'], 
					"fk_product"    =>  $producto['id'], 
					"product_type"  =>  "1", 
					"rang"          =>  "-1", 
				);
				$agregar_lineas = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$pedido_id."/lines", json_encode($linea)); //Agregar linea a factura
				//echo var_dump($agregar_lineas);
				$stock_mov = array(
					"product_id"        => $producto['id'],
					"warehouse_id"      => $this->almacenDuki,
					"qty"               => -1*$peso_real,
					"movementcode"      =>"DUKI".$pedido_id.$producto['pedidos_productos']['id'],
					"movementlabel"     =>"Surtido pedido DUKI id ".$producto['pedidos_productos']['id'],
					"dlc"               => date("Y-m-d"),
					"dluo"              => date("Y-m-d"),
				);
				$inventarioNuevo = $producto['inventario'] - $peso_real;
				$stock_mov_duki = array(
					'id'=>$producto['id'],
					'inventario'=>$inventarioNuevo
				);
				if($this->Producto->save($stock_mov_duki)){
					$this->callAPI("POST", $this->apiKey, $this->apiUrl."stockmovements", json_encode($stock_mov));//Realizar baja de inventario
				}
			}

			$linea_envio = array(
				"desc"          =>  "Servicio de Entrega", 
				"subprice"      =>  $envio, 
				"qty"           =>  1,
				"tva_tx"        =>  0, 
				"product_type"  =>  "1", 
				"rang"          =>  "-1", 
			);
			$agregar_lineas = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$pedido_id."/lines", json_encode($linea_envio)); //Agregar linea a factura
			//echo var_dump($agregar_lineas);
		//}
		$opciones_validado = array(
			'idwarehouse'=>0,
			'notrigger'=>0
		);
		$this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$pedido_id."/validate",json_encode($opciones_validado));
		return $pedido_id;

	}

	function validarFactura($pedido_id = null){
		$opciones_validado = array(
			'idwarehouse'=>0,
			'notrigger'=>0
		);
		$validar = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$pedido_id."/validate",json_encode($opciones_validado));
		echo var_dump($validar);
	}

	function processPayment($id_pedido = null,$tipo_pago = null,$monto = null){
		$datos_pago = array();
		$forma_pago = 0;
		switch ($tipo_pago):
			case 1: //Pago en efectivo
				$forma_pago = $this->paiment_id_cash;
				$datos_pago = array(
					"datepaye" => strtotime(date("Y-m-d")),
					"paiementid" => $forma_pago,
					"closepaidinvoices" => "yes",
					"accountid" => $this->ctatc,
					'num_paiement' => "EFE".date("ymdhis"),
				);
				$pago = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$id_pedido."/payments", json_encode($datos_pago));
				return 1;
			break;
			case 2: //Pago con transferencia
				$forma_pago=$this->paiment_id_transfer;
				$datos_pago = array(
					"datepaye" => strtotime(date("Y-m-d")),
					"paiementid" => $forma_pago,
					"closepaidinvoices" => "yes",
					"accountid" => $this->ctatc,
				);
				$pago = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$id_pedido."/payments", json_encode($datos_pago));
				//$this->set('pago',json_decode($pago, true));
				return 1;
			break;
			default:
				$forma_pago=$this->paiment_id_cc;
				$this->loadModel('MetodosPago');
				App::import('Controller', 'MetodosPagos'); 
				$metodosPagos = new MetodosPagosController;
				$pago = $this->MetodosPago->find('first',array('conditions'=>array('MetodosPago.id'=>$tipo_pago)));
				$numeroTarjeta = $metodosPagos->decrypt($pago['MetodosPago']['numero_tarjeta'],$this->encryptKey,true);
				$formatoTarjeta = chunk_split($numeroTarjeta,4," ");
				$data['nombre'] = $pago['MetodosPago']['nombre'];
				$data['apellidos'] = $pago['MetodosPago']['apellidos'];
			   //Poner instrucciones de pagofacil
				$curl = curl_init();

				$opt_curl = array(
					CURLOPT_URL => 'https://api.pagofacil.tech/Wsrtransaccion/index/format/json?',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => array(
						'method' => 'transaccion',
						'data[nombre]' => $data['nombre'],
						'data[apellidos]' => $data['apellidos'],
						'data[numeroTarjeta]' => $formatoTarjeta,
						'data[cvt]' => $metodosPagos->decrypt($pago['MetodosPago']['cvv'],$this->encryptKey,true),
						'data[cp]' => $pago['MetodosPago']['cp'],
						'data[mesExpiracion]' => $pago['MetodosPago']['mes_vencimiento'],
						'data[anyoExpiracion]' => $pago['MetodosPago']['anio_vencimiento'],
						'data[monto]' => $monto,
						//'data[idSucursal]' => 'ipqn7tqjxgwlay95ezv6j1orsotg8n2byfkhxfbm', //Pruebas
						//'data[idUsuario]' => 'ykg1mzle7dnuufhixooy5vnx3ieztp2q4rlbwcbr', //Pruebas
						'data[idSucursal]' => '85c5beb77893d56547e10745befa52d546054700', //Productivo
						'data[idUsuario]' => '5d5375f890c7dbdb4da8373d84352d63e38ebcee', //Productivo
						'data[idServicio]' => '3',
						'data[email]' => $this->Session->read('Auth.User.email'),
						'data[telefono]' => $this->Session->read('Auth.User.telefono'),
						'data[celular]' => $this->Session->read('Auth.User.celular'),
						'data[calleyNumero]' => $pago['MetodosPago']['calle_numero'],
						'data[colonia]' => $pago['MetodosPago']['colonia'],
						'data[municipio]' => $pago['MetodosPago']['municipio'],
						'data[estado]' => $pago['MetodosPago']['estado'],
						'data[pais]' => $pago['MetodosPago']['pais'],
						'data[idPedido]' => $id_pedido,
						'data[httpUserAgent]' => $_SERVER['HTTP_USER_AGENT'],
						'data[ip]' => '1.1.1.1'
					),
				);
				curl_setopt_array($curl, $opt_curl);
				//echo var_dump($opt_curl);
				$response = curl_exec($curl);
				$respuesta = json_decode($response,true);
				//$this->set(compact('respuesta'));

				if($respuesta['WebServices_Transacciones']['transaccion']['autorizado']!=1){//El proceso de pago facil no pasa
					$data = array('id' => $this->Cookie->read('pedido'),'status' => 1);
					$this->Pedido->save($data);
					$this->Session->setFlash("No fue posible procesar tu pago. Intenta de nuevo: ".utf8_decode($respuesta['WebServices_Transacciones']['transaccion']['texto']).': '.json_encode($respuesta['WebServices_Transacciones']['transaccion']['error']) ,'default' ,array('class'=>'error'));
					/*actualizar status del pedido
					$newStatus = array('id' => $id_pedido,'status' => 1);  
					$this->Pedido->save($newStatus);*/
					$this->redirect(array('action'=>'pagar','controller'=>'pedidos'));
					//echo var_dump($respuesta);
					break;
				}
				$datos_pago= array(
					'num_paiement' => $respuesta['WebServices_Transacciones']['transaccion']['idTransaccion'],
				);
				curl_close($curl);
				$datos_pago = array(
					"datepaye" => strtotime(date("Y-m-d")),
					"paiementid" => $forma_pago,
					"closepaidinvoices" => "yes",
					"accountid" => $this->ctatc,
				);
				$pago = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$id_pedido."/payments", json_encode($datos_pago));
				//$this->set('pago',json_decode($pago, true));
				return 1;
			break;
		endswitch;
	}

	public function cancelar(){
		$unitario = $this->request->data['Pedido']['evidencia'];
		$filename = getcwd()."/files/pedidos/devoluciones/".$this->request->data['Pedido']['id'].".".explode(".",$unitario['name'])[1];
		move_uploaded_file($unitario['tmp_name'],$filename);
		$ruta = "/files/pedidos/devoluciones/".$this->request->data['Pedido']['id'].".".explode(".",$unitario['name'])[1];
		$this->request->data['Pedido']['evidencia_cancelacion'] = $ruta;
		$this->request->data['Pedido']['c_e_7']=$this->Session->read('Auth.User.nombres')." ".$this->Session->read('Auth.User.apellido_paterno')." ".$this->Session->read('Auth.User.apellido_materno');
		$this->request->data['Pedido']['c_e_d_7']=date('Y-m-d H:i:s');
		$this->request->data['Pedido']['status']=7;
		if($this->Pedido->save($this->request->data)){
			$this->Session->setFlash("El pedido ha sido cambiado a Solicitar autorización de devolución", 'default' ,array('class'=>'success'));
			$this->redirect(array('controller'=>'pedidos','action'=>'view',$this->request->data['Pedido']['id']));
		}
	}

	public function autorizar_cancelar(){
		$this->request->data['Pedido']['c_e_8']=$this->Session->read('Auth.User.nombres')." ".$this->Session->read('Auth.User.apellido_paterno')." ".$this->Session->read('Auth.User.apellido_materno');
		$this->request->data['Pedido']['c_e_d_8']=date('Y-m-d H:i:s');
		$this->request->data['Pedido']['status']=8;
		if($this->Pedido->save($this->request->data)){
			$this->Session->setFlash("El pedido ha sido autorizado para cancelación / devolución.", 'default' ,array('class'=>'success'));
			$this->redirect(array('controller'=>'pedidos','action'=>'view',$this->request->data['Pedido']['id']));
		}
	}

	function getTotal($idPedido = null){
		$this->Pedido->Behaviors->load('Containable');
		$pedido = $this->Pedido->find(
			'all',
			array(
				'conditions'=>array(
					'Pedido.id'=> $idPedido
				)
			)
		);
		$total = 0;
		$descuento =0;
		foreach($pedido[0]['Productos'] as $producto):
			$total += $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'];
		endforeach;
		if($pedido[0]['Pedido']['cupon'] != ""){
			$this->loadModel('Cupon');
			$cupon = $this->Cupon->find('first',array('conditions'=>array('Cupon.cupon'=>$pedido[0]['Pedido']['cupon'])));
			switch($cupon['Cupon']['tipo_descuento']):
				case(2):
					$descuento = $total*($cupon['Cupon']['monto']/100);
				break;
				case(1):
					$descuento = $cupon['Cupon']['monto'];
				break;
			endswitch;
			$total = $total - $descuento;
		}

		//Revisar tipo de Entrega
		if ($pedido[0]['Pedido']['horario_entrega']=='Pedido Express'){
			if($total <= 899){
				$total = $total + 69;
			}
		}else{
			if($total <= 499){
				$total = $total + 49;
			}
		}

		return $total;
	}

	function callAPI($method, $apikey, $url, $data = false) {
		$curl = curl_init();
		$httpheader = ['DOLAPIKEY: '.$apikey];

		switch ($method)
		{
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				$httpheader[] = "Content-Type:application/json";

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				break;
			case "PUT":

			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
				$httpheader[] = "Content-Type:application/json";

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		// Optional Authentication:
		//    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}

	//MÉTODOS PARA PRUEBAS INDIVIDUALES. NO FUNCIONAN DENTRO DE DUKIsend
	public function viewMail($id_pedido = null){

		$this->set('pedido',$this->Pedido->read(null,'155')); 
	}

	public function deleteCookie(){
		$this->Cookie->destroy('pedido');
		$this->render(false);
	}

	public function procesaPagoDoli($id_pedido = null, $forma_pago = null){
            $datos_pago = array(
                "datepaye" => strtotime(date("Y-m-d")),
                "paiementid" => $forma_pago,
                "closepaidinvoices" => "yes",
                "accountid" => $this->ctatc,
                'num_paiement' => "PAGO FORZADO POR MÉTODO",
            );
            $pago = $this->callAPI("POST", $this->apiKey, $this->apiUrl."invoices/".$id_pedido."/payments", json_encode($datos_pago));
            $this->set('pago',json_decode($pago, true));
            $this->render(false);
    }
	
	function desencriptar_php72($encodedInitialData, $key) {
        $auth = false;
        $data = base64_decode($encodedInitialData, true);
        try {
            $iv_size = openssl_cipher_iv_length($this->getMethod());
            $iv = substr($data, 0, $iv_size);
            $data = substr($data, $iv_size);
            $decrypted = openssl_decrypt($data, $this->getMethod(), $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);

            $decrypted = preg_replace('/^(",")/', '"', self::pkcs5_unpad($decrypted));
            $decrypted = preg_replace('/^(htt)/', '"u":"htt', $decrypted);
            
            if(stripos($decrypted, 'Transaccion exitosa')) {
                $auth = true;
            }
            $decryptedArray = json_decode('{'.$decrypted);
            
            $decryptedArray->autorizado = $auth ? self::AUTORIZADO : self::RECHAZADO;
            
            return json_encode($decryptedArray);
        } catch (Exception $exc) {
            return '';
        }
    }
	
	public function getMethod() {
        return $this->_method;
    }
	
	private static function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, -1 * $pad);
    }
	
	public function pago_view(){
		$this->layout='';
		$this->view='pagofacil';
	}
	
	public function nuevo_descuento(){
		$id_pedido = $this->request->data('id_pedido');
		$descuento = $this->request->data('descuento');
		$pedido = array(
			'id' => $id_pedido,
			'descuento' => $descuento
		);
		if($this->Pedido->save($pedido)){
			$obj = true;
		}else{
			$obj = false;
		}
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}
}
    ?>