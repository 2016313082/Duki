<?php
class UsersController extends AppController {
    
    
    var $name = 'Users';

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('login','login_portable','logout','crear_cuenta','login_admin','recuperar_password','crear_cuenta_portable'));
    }

    public function totales(){
        $this->loadModel('Pedido');
        $this->loadModel('Producto');
        $obj['clientes'] = $this->User->query('SELECT COUNT(*) as total_clientes FROM `users` where activo = 0');
        $obj['pedidos_terminados'] = $this->Pedido->query('SELECT COUNT(*) as pedidos_terminados FROM `pedidos` where status = 6');
        $obj['total_vendido'] = $this->Pedido->query('SELECT sum(subtotal+iva+ieps) as total_vendido FROM `pedidos` where status = 6');
        $obj['total_productos'] = $this->Producto->query('SELECT COUNT(*) as total_productos FROM `productos` WHERE activo = 1');

        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function login() {
		$this->Cookie->destroy('pedido');
        if ($this->request->is('post')) {
            if (!$this->Auth->login()) {
                $this->Session->setFlash(__('Usuario y/o password incorrecto.', true), 'default' ,array('class'=>'error'));
                //return $this->redirect($this->Auth->redirect());
            }else{
                if($this->Session->read('Auth.User.interno')==false){
                    $obj['resultado'] = true; 
                    $arreglo = [];
                    $arreglo_total = [];
                    $arreglo_delete = [];
                    $this->loadModel('Pedido');
                    $pedido = $this->Pedido->find('all',
                        array(
                            'conditions'=>array(
                                'user_id'=>$this->Session->read('Auth.User.id'),
                                'status'=>1
                            )
                        ));
                        
                    $this->loadModel('PedidosProducto');
                    $items = $this->PedidosProducto->find('count',
                        array(
                            'conditions'=>array(
                                'pedido_id'=>$pedido[0]['Pedido']['id']
                            )
                    ));
                    if($items > 0){
                        $carrito = $this->PedidosProducto->query('SELECT fotografia,pedidos_productos.id,producto_id,pedido_id,cantidad_solicitada,monto_solicitado,iva_solicitado,ieps_solicitado,unidad_solicitada,precio_venta,tasa_iva,tasa_ieps,conversion,unidad_principal,unidad_secundaria,inventario FROM pedidos_productos inner join productos on pedidos_productos.producto_id = productos.id where pedido_id = '.$pedido[0]['Pedido']['id']);
                    }

                    foreach($carrito as $productos){
                        if($productos['productos']['inventario'] > 0.5){
                            //$precio_venta = $productos;
                            if($productos['pedidos_productos']['unidad_solicitada'] == 'Kg'){
                                $conversion = 1;
                            }else{
                                $conversion = $productos['productos']['conversion'];
                            }
                            $precio_venta = $productos['productos']['precio_venta'] * ($productos['pedidos_productos']['cantidad_solicitada']*$conversion);
                            $precio_iva = ($productos['productos']['tasa_iva']/100) * $precio_venta;
                            $precio_ieps = ($productos['productos']['tasa_ieps']/100) * $precio_venta;

                            $arreglo = array(
                                'id' => $productos['pedidos_productos']['id'],
                                'producto_id'=>$productos['pedidos_productos']['producto_id'],
                                'monto_solicitado'=>number_format($precio_venta,2),
                                'iva_solicitado'=>number_format($precio_iva,2),
                                'ieps_solicitado'=>number_format($precio_ieps,2)
                            );
                            //$this->PedidosProducto->save($arraglo);
                            if($this->PedidosProducto->save($arreglo)){
                                $obj['$carrito_actualizado'] = true;
                            }else{
                                $obj['$carrito_actualizado'] = false;
                            }
                        }else{
                            $this->PedidosProducto->delete($productos['pedidos_productos']['id']);
                            //$this->deleteProduct2($productos['pedidos_productos']['id']);
                        }
                            
                    }
                    $pedidos['campos'] = $this->Pedido->find('all',
                    array(
                        'conditions'=>array(
                            'user_id'=>$this->Session->read('Auth.User.id'),
                            'status'=>1
                        )
                    ));
                    return $this->redirect(array('controller' => 'pages', 'action' => 'display'));  
                }else{
					$this->Auth->logout();

                    $this->Session->setFlash(__('Este usuario es nivel administrador, ingresa un usuario nivel cliente', true), 'default' ,array('class'=>'error'));
                }
            }
        }
    }

    public function login_portable(){
        if ($this->request->is('post')) {
            if (!$this->Auth->login()){
                $obj['resultado'] = false;
                $obj['mensaje'] = 'Usuario o contraseña equivocados';
            }else{
                if($this->Session->read('Auth.User.interno')==false){
                    $obj['resultado'] = true; 
                    $arreglo = [];
                    $arreglo_total = [];
                    $arreglo_delete = [];
                    $this->loadModel('Pedido');
                    $pedido = $this->Pedido->find('all',
                        array(
                            'conditions'=>array(
                                'user_id'=>$this->Session->read('Auth.User.id'),
                                'status'=>1
                            )
                        ));
                        
                    $this->loadModel('PedidosProducto');
                    $items = $this->PedidosProducto->find('count',
                        array(
                            'conditions'=>array(
                                'pedido_id'=>$pedido[0]['Pedido']['id']
                            )
                    ));
                    if($items > 0){
                        $carrito = $this->PedidosProducto->query('SELECT fotografia,pedidos_productos.id,producto_id,pedido_id,cantidad_solicitada,monto_solicitado,iva_solicitado,ieps_solicitado,unidad_solicitada,precio_venta,tasa_iva,tasa_ieps,conversion,unidad_principal,unidad_secundaria,inventario FROM pedidos_productos inner join productos on pedidos_productos.producto_id = productos.id where pedido_id = '.$pedido[0]['Pedido']['id']);
                    }

                    foreach($carrito as $productos){
                        if($productos['productos']['inventario'] > 0.5){
                            //$precio_venta = $productos;
                            if($productos['pedidos_productos']['unidad_solicitada'] == 'Kg'){
                                $conversion = 1;
                            }else{
                                $conversion = $productos['productos']['conversion'];
                            }
                            $precio_venta = $productos['productos']['precio_venta'] * ($productos['pedidos_productos']['cantidad_solicitada']*$conversion);
                            $precio_iva = ($productos['productos']['tasa_iva']/100) * $precio_venta;
                            $precio_ieps = ($productos['productos']['tasa_ieps']/100) * $precio_venta;

                            $arreglo = array(
                                'id' => $productos['pedidos_productos']['id'],
                                'producto_id'=>$productos['pedidos_productos']['producto_id'],
                                'monto_solicitado'=>number_format($precio_venta,2),
                                'iva_solicitado'=>number_format($precio_iva,2),
                                'ieps_solicitado'=>number_format($precio_ieps,2)
                            );
                            //$this->PedidosProducto->save($arraglo);
                            if($this->PedidosProducto->save($arreglo)){
                                $obj['$carrito_actualizado'] = true;
                            }else{
                                $obj['$carrito_actualizado'] = false;
                            }
                        }else{
                            $this->PedidosProducto->delete($productos['pedidos_productos']['id']);
                            //$this->deleteProduct2($productos['pedidos_productos']['id']);
                        }
                            
                    }
                    $pedidos['campos'] = $this->Pedido->find('all',
                    array(
                        'conditions'=>array(
                            'user_id'=>$this->Session->read('Auth.User.id'),
                            'status'=>1
                        )
                    ));
                    
                }else{
					$obj['resultado'] = false;
                    $obj['mensaje'] = 'Usuario nivel administrador';
                }
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }


    public function login_admin() {
        $this->layout='login_admin';
        if ($this->request->is('post')) {
            if (!$this->Auth->login()) {
                $this->Session->setFlash(__('Usuario y/o password incorrecto.', true), 'default' ,array('class'=>'error'));
                //return $this->redirect($this->Auth->redirect());
            }
            else{
                if ($this->Session->read('Auth.User.interno') && $this->Session->read('Auth.User.activo')){
                    return $this->redirect(array('controller'=>'pedidos','action'=>'index'));
                }else{
                    $this->Auth->logout();
					$this->redirect(array("controller" => "users", "action" => "login"));
                    $this->Session->setFlash(__('No es posible acceder a esta sección', true), 'default' ,array('class'=>'error'));
                }
                
            }
        }
    }

    public function recuperar_password(){
        if($this->request->is('post')){
            $nuevo_password = uniqid();
            $this->User->Behaviors->load('Containable');
            $usuario = $this->User->find(
                'first',
                array(
                    'fields'=>array(
                        'id','nombres','apellido_paterno','apellido_materno'
                    ),
                    'contain'=>false,
                    'conditions'=>array(
                        'User.email'=>$this->request->data['User']['email']
                    )
                )
            );

            $nombre_completo = $usuario['User']['nombres']." ".$usuario['User']['apellido_paterno']." ".$usuario['User']['apellido_materno'];

            $user = array(
                'id'=>$usuario['User']['id'],
                'password'=>$this->Auth->password($nuevo_password)
            );

            if($this->User->save($user)){
                $Email = new CakeEmail();
                $Email->config(array(
                    'host' => 'mail.duki.mx',
                    'port' => '587',
                    'username' => 'pedidos@duki.mx',
                    'password' => 'Pedidos.2021',
                    'transport' => 'Smtp'
                    )
                );
                $Email->template('recuperar_password','general'); //Email/view , Layouts/Email/layout
                $Email->to($this->request->data['User']['email']);
                $Email->from(array('notificaciones@duki.mx'=>'Notificaciones Duki.MX'));
                $Email->subject('Solicitud de cambio de contraseña');
                $Email->emailFormat('html');
                $Email->viewVars(array('password' => $nuevo_password,'nombre'=>$nombre_completo));
                $Email->send();

                $this->Session->setFlash(__('Tu nueva contraseña temporal ha sido enviada a tu correo.', true), 'default' ,array('class'=>'success'));
                return $this->redirect(array('action'=>'login'));        
            }
        }
    }

    public function logout() {
        $this->Session->setFlash(__('¡Gracias por visitar Duki.mx! ¡Te esperamos pronto!', true), 'default' ,array('class'=>'success'));
        return $this->redirect($this->Auth->logout());
    }

    public function prueba(){
        $obj = $this->Pedido->find(
            'all',
            array(
                'fields' => 'count(user_id),user_id',
                'group' => 'user_id',
                'conditions' => 'status > 1'
            )
        );

        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function dashboard(){
        $this->layout='admin';
        $this->view='dashboard';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
    }

    public function clientes(){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->User->Behaviors->load('Containable');
        $this->set(
            'clientes',
            $this->User->find(
                'all',
                array(
                    'conditions'=>array(
                        'User.interno = 0 order by id desc'
                    ),
                    'fields'=>array(
                        'id','nombres','apellido_paterno','apellido_materno','telefono','email','celular','cumpleanos','fecha_registro'
                    ),
                    'contain'=>array(
                        'PedidosRealizados',
                        'CarritosAbandonados'
                    )
                )
            )
        );
    }

    public function viewCliente($id = null){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->User->Behaviors->load('Containable');
        $this->set(
            'cliente',
            $this->User->find(
                'first',
                array(
                    'conditions'=>array(
                        'User.id'=>$id
                    ),
                    'recursive'=>2,
                    'fields'=>array(
                        'id','nombres','apellido_paterno','apellido_materno','telefono','email','celular'
                    ),
                    'contain'=>array(
                        'PedidosRealizados',
                        'CarritosAbandonados',
                        'Pedidos'=>array(
                            'Productos'
                        )
                    )
                )
            )
        );
    }

    public function index(){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->set('usuarios',$this->User->findAllByInterno(1));
    }

    public function add(){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        if($this->request->is('post')){
            $this->request->data['User']['interno']=1;
            $this->request->data['User']['activo']=1;
            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('El usuario ha sido agregado existosamente','default',array('class'=>'success'));
                $this->redirect(array('controller'=>'users','action'=>'index'));
            }
        }
    }

    public function edit($id = null){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        if($this->request->is('post')){
            if($this->request->data['User']['password']!=""){
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
            }else{
                unset($this->request->data['User']['password']);
            }
            
            if($this->User->save($this->request->data['User'])){
                $this->Session->setFlash('El usuario ha sido modificado existosamente','default',array('class'=>'success'));
                $this->redirect(array('controller'=>'users','action'=>'index'));
            }else{
                $this->Session->setFlash('El usuario no ha sido modificado existosamente','default',array('class'=>'error'));
                $this->set('errores',$this->User->invalidFields());
            }
        }else{
            $this->set('user',$this->User->read(null,$id));
        }
    }

    function baja($id = null, $status = null) {
        if (!$id) {
            $this->Session->setFlash(__('Entrega invalida', true));
            $this->redirect(array('action'=>'index'));
        }
        $usuario = array(
            'id'=>$id,
            'activo'=>$status
        );
        if ($this->User->save($usuario)) {
            $this->Session->setFlash(__('El usuario se ha dado de baja exitosamente', true), 'default' ,array('class'=>'mensaje_exito'));
            $this->redirect(array('action'=>'index','controller'=>'users'));
        }
    }
        

    public function mi_cuenta(){
        if($this->Session->read('Auth.User.interno')==false){
            $this->request->data = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('Auth.User.id'))));
            App::import('Controller', 'MetodosPagos'); 
            $metodosPagos = new MetodosPagosController;
            for($i=0;$i<sizeof($this->request->data['MetodosPago']);$i++){
                $this->request->data['MetodosPago'][$i]['numero_tarjeta'] = substr($metodosPagos->decrypt($this->request->data['MetodosPago'][$i]['numero_tarjeta'],$this->encryptKey,true),12,4);
            }
            $this->loadModel('Cp');
            $cps = $this->Cp->find('all');
            $cp_array = array();
            foreach($cps as $cp):
                $cp_array[$cp['Cp']['id']] = $cp['Cp']['colonia'].", CP ".$cp['Cp']['cp'].", ".$cp['Cp']['municipio'].", ".$cp['Cp']['ciudad'].", ".$cp['Cp']['estado'];
            endforeach;
            $this->set('cps',$cp_array);

            $tipos_tarjeta = [
                'MC' => 'mc.png',
                'AMEX' => 'amex.png',
                'VISA' => 'visa.png'
            ];
            $this->set('tipos_tarjeta',$tipos_tarjeta);

            $this->loadModel('Pedido');
            $pedidos = $this->Pedido->find(
                'all',
                array(
                    'conditions'=>array(
                        'Pedido.user_id'=>$this->Session->read('Auth.User.id')
                    )
                )
            );
            $this->set('pedidos',$pedidos);
        }
    }

    public function editar_cuenta(){
        $this->request->data['User']['cumpleanos'] = $this->request->data['User']['dia']."/".$this->request->data['User']['mes'];
        if($this->User->save($this->request->data)){
            $this->Session->setFlash('Tus datos han sido modificados exitosamente','default',array('class'=>'success'));
        }else{
            $this->Session->setFlash('No pudimos modificar los datos de tu cuenta. Por favor intÃ©ntalo de nuevo','default',array('class'=>'error'));
        }
        $this->redirect(array('controller' => 'users','action'=>'mi_cuenta'));
    }

    public function editar_password(){
        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
        if($this->User->save($this->request->data)){
            $this->Session->setFlash('Tu contaseña ha sido modificada exitosamente','default',array('class'=>'success'));
        }else{
            $this->Session->setFlash('No pudimos modificar tu contraseña. Por favor inténtalo de nuevo','default',array('class'=>'error'));
        }
        $this->redirect(array('controller' => 'users','action'=>'mi_cuenta'));
    }

    public function crear_cuenta_portable(){
        if ($this->request->is('post')){
            $existe = $this->User->find('count',array('conditions'=>array('User.email'=>$this->request->data['email'])));
            if($existe==0){
				$this->request->data['password'] = $this->Auth->password($this->request->data['password']);
				$this->request->data['fecha_registro'] = date('Y-m-d H:i:s');
				$obj['data'] = $this->request->data;
				if($this->User->save($this->request->data)){
					$this->loadModel('Cupon');
                    $cupon = array(
                        'cupon'=>uniqid(),
                        'monto'=>200,
                        'tipo_descuento'=>1,
                        'fecha_inicial'=>date("Y-m-d"),
						'fecha_final'=>'2022-12-31',
						'monto_minimo_compra'=>599,
						'unique'=>1
                    );
                    if($this->Cupon->save($cupon)){
                        $Email = new CakeEmail();
                        $Email->template('lp1','lp1');
                        $Email->to($this->request->data['email']); 
                        $Email->from(array('noreply@duki.mx'=>'Notificaciones Duki.mx'));
                        $Email->subject('Cupón de Bienvenida DUKI');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('cupon' => $cupon['cupon']));
                        $Email->send();
                    }
					$id_user = $this->User->getInsertID();
					$usuario = $this->User->find('first',array('conditions'=>array('User.id'=>$id_user)));
					if($this->Auth->login($usuario['User'])){
						if($this->Session->read('Auth.User.interno')==false){
                            $obj['resultado'] = true;
                            $this->response->type('json');
                            $this->response->body(json_encode($obj));
                            return $this->response;
						}
					}
				}else{
					$obj['resultado'] = false;
                    $obj['resultado'] = 'Esta cuenta es nivel administrador';
				}
			}else{
				$obj['resultado'] = false;
                $obj['resultado'] = 'Este correo ya fue registrado';
			}    
        }else{
            $obj['resultado'] = false;
            $obj['resultado'] = 'No pudimos crear tu cuenta';
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
	
	//Arreglar crear cuenta, ocupar $this->Auth->login()
    public function crear_cuenta(){ 
		/*$this->loadModel('MetodosPago');
		App::import('Controller', 'MetodosPagos');
		$metodosPagos = new MetodosPagosController;*/
        if ($this->request->is('post')){
            $existe = $this->User->find('count',array('conditions'=>array('User.email'=>$this->request->data['User']['email'])));
            if($existe==0){
				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
				$this->request->data['User']['fecha_registro'] = date('Y-m-d H:i:s');
				if($this->User->save($this->request->data)){
					$this->Session->setFlash('Tu cuenta ha sido creada exitosamente, revisa tu correo y utiliza tu cupón de descuento','default',array('class'=>'success'));
					$this->loadModel('Cupon');
                    $cupon = array(
                        'cupon'=>uniqid(),
                        'monto'=>200,
                        'tipo_descuento'=>1,
                        'fecha_inicial'=>date("Y-m-d"),
						'fecha_final'=>'2022-12-31',
						'monto_minimo_compra'=>599,
						'unique'=>1
                    );
                    if($this->Cupon->save($cupon)){
                        $Email = new CakeEmail();
                        $Email->template('lp1','lp1');
                        $Email->to($this->request->data['User']['email']); 
                        $Email->from(array('noreply@duki.mx'=>'Notificaciones Duki.mx'));
                        $Email->subject('Cupón de Bienvenida DUKI');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('cupon' => $cupon['cupon']));
                        $Email->send();
                    }
					$id_user = $this->User->getInsertID();
					$usuario = $this->User->find('all',array('conditions'=>array('User.id'=>$id_user)));
					if($this->Auth->login($usuario[0]['User'])){
						if($this->Session->read('Auth.User.interno')==false){
							$this->redirect(array('action' => 'home','controller'=>'pages'));
						}
					}
				}else{
					$this->Auth->logout();
					$this->Session->setFlash(__('Este usuario es nivel administrador, ingresa un usuario nivel cliente', true), 'default' ,array('class'=>'error'));
				}
			}else{
				
				$this->Session->setFlash('Ya existe una cuenta registrada con este correo.','default',array('class'=>'error'));
				$this->redirect(array('action' => 'home','controller'=>'pages'));
			}    
        }else{
            $this->Session->setFlash('No pudimos crear tu cuenta. Por favor inténtalo de nuevo','default',array('class'=>'error'));
			$this->redirect(array('action' => 'home','controller'=>'pages'));
        }
    }
	/*
		if ($this->request->is('post')) {
            if (!$this->Auth->login()) {
                $this->Session->setFlash(__('Usuario y/o password incorrecto.', true), 'default' ,array('class'=>'error'));
                //return $this->redirect($this->Auth->redirect());
            }else{
                if($this->Session->read('Auth.User.interno')==false){
                    return $this->redirect($this->Auth->redirect());   
                }else{
					$this->Auth->logout();

                    $this->Session->setFlash(__('Este usuario es nivel administrador, ingresa un usuario nivel cliente', true), 'default' ,array('class'=>'error'));
                }
            }
        }
	*/
}
?>