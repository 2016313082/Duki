<?php
class DireccionsController extends AppController {
    
    var $name = 'Direccions';

    public function add(){
        if ($this->request->is('post')){
            $cp_id = $this->request->data['Direccion']['cp_id'];
            $this->loadModel('Cp');
            $cp = $this->Cp->read(null,$cp_id);
            $this->request->data['Direccion']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Direccion']['cp'] = $cp['Cp']['cp'];
            $this->request->data['Direccion']['colonia'] = $cp['Cp']['colonia'];
            $this->request->data['Direccion']['municipio'] = $cp['Cp']['municipio'];
            $this->request->data['Direccion']['ciudad'] = $cp['Cp']['ciudad'];
            $this->request->data['Direccion']['estado'] = $cp['Cp']['estado'];
            $this->request->data['Direccion']['pais'] = 'México';
            if($this->Direccion->save($this->request->data)){
                $this->Session->setFlash('Tu dirección se ha registrado exitosamente','default',array('class'=>'success'));
                $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
            }
       }
    }

    public function edit(){
        if ($this->request->is('post')){
            $cp_id = $this->request->data['Direccion']['cp_id'];
            $this->loadModel('Cp');
            $cp = $this->Cp->read(null,$cp_id);
            $this->request->data['Direccion']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Direccion']['cp'] = $cp['Cp']['cp'];
            $this->request->data['Direccion']['colonia'] = $cp['Cp']['colonia'];
            $this->request->data['Direccion']['municipio'] = $cp['Cp']['municipio'];
            $this->request->data['Direccion']['ciudad'] = $cp['Cp']['ciudad'];
            $this->request->data['Direccion']['estado'] = $cp['Cp']['estado'];
            $this->request->data['Direccion']['pais'] = 'México';
            if($this->Direccion->save($this->request->data)){
                $this->Session->setFlash('Tu dirección se ha registrado exitosamente','default',array('class'=>'success'));
                $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
            }
       }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Dirección invalida', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Direccion->delete($id)) {
            $this->Session->setFlash(__('La dirección ha sido eliminada exitosamente', true), 'default' ,array('class'=>'success'));
            $this->redirect(array('action' => 'mi_cuenta','controller'=>'users'));
        }
    }
	
	function ver_direcciones($id = null){
		$id = $this->Session->read('Auth.User.id');	
		$obj = $this->Direccion->find(
			'all',
			array(
				'conditions' => array(
					'Direccion.user_id' => $id,
				)
			)
		);
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}

    public function contar_direcciones(){
        $id = $this->Session->read('Auth.User.id');	
		$obj = $this->Direccion->find(
			'count',
			array(
				'conditions' => array(
					'Direccion.user_id' => $id,
				)
			)
		);
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_direccion(){
        $id = $this->request->data['id'];
		$obj = $this->Direccion->find(
			'first',
			array(
				'conditions' => array(
					'Direccion.id' => $id,
				)
			)
		);
		
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }
	
	public function traer_cp($id = null){
		$id = $this->request->data['id'];
		$this->loadModel('Cp');
		$obj = $this->Cp->find(
			'first',
			array(
				'conditions' => array(
					'Cp.id' => $id,
				)
			)
		);
		
		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}
	
	public function registrar_direccion(){
        if ($this->request->is('post')){
            $cp_id = $this->request->data['Direccion']['cp_id'];
            $this->loadModel('Cp');
            $cp = $this->Cp->read(null,$cp_id);
            $this->request->data['Direccion']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Direccion']['cp'] = $cp['Cp']['cp'];
            $this->request->data['Direccion']['colonia'] = $cp['Cp']['colonia'];
            $this->request->data['Direccion']['municipio'] = $cp['Cp']['municipio'];
            $this->request->data['Direccion']['ciudad'] = $cp['Cp']['ciudad'];
            $this->request->data['Direccion']['estado'] = $cp['Cp']['estado'];
            $this->request->data['Direccion']['pais'] = 'México';
            if($this->Direccion->save($this->request->data)){
                $this->loadModel('Pedido');
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
                $carrito = array(
                    'calle_envio' => $this->request->data['Direccion']['calle'],
                    'numero_interior_envio' => $this->request->data['Direccion']['numero_interior'],
                    'numero_exterior_envio' => $this->request->data['Direccion']['numero_exterior'],
                    'cp_id_envio' => $this->request->data['Direccion']['cp_id'],
                    'id' => $id_pedido
                );
                if($this->Pedido->save($carrito)){
                    $obj['resultado'] = true;
                }else{
                    $obj['resultado'] = false;
                    $obj['mensaje'] = 'La dirección no pudo ser agregada a tu pedido';
                }
            }else{
                $obj['resultado'] = false;
                $obj['mensaje'] = 'Algo salio mal, no se pudo registrar la direccion';
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
}
?>