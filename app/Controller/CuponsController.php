<?php
class CuponsController extends AppController {
    
    var $name = 'Cupons';

    public function index(){
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->layout='admin';
        $this->set('cupones',$this->Cupon->find('all'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Entrega invalida', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Cupon->delete($id)) {
            $this->Session->setFlash(__('El cupón ha sido eliminado exitosamente', true), 'default' ,array('class'=>'success'));
            $this->redirect(array('action' => 'index','controller'=>'cupons'));
        }
    }

    function add(){
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        if ($this->request->is('post')){
            $this->request->data['Cupon']['fecha_inicial'] = date("Y-m-d",strtotime(substr($this->request->data['Cupon']['rango_fechas'],0,10)));
            $this->request->data['Cupon']['fecha_final'] = date("Y-m-d",strtotime(substr($this->request->data['Cupon']['rango_fechas'],-10)));
            if($this->Cupon->save($this->request->data)){
                $this->Session->setFlash(__('El cupón ha sido creado exitosamente', true), 'default' ,array('class'=>'success'));
                $this->redirect(array('action' => 'index','controller'=>'cupons')); 
            }
        }
    }
}
?>