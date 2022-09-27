<?php
class BannersController extends AppController {
    
    var $name = 'Banners';

    public function index(){
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->layout='admin';
        $this->set('banners',$this->Banner->find('all'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Entrega invalida', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Banner->delete($id)) {
            $this->Session->setFlash(__('El Banner ha sido eliminado exitosamente', true), 'default' ,array('class'=>'success'));
            $this->redirect(array('action' => 'index','controller'=>'banners'));
        }
    }

    function add(){
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        if ($this->request->is('post')){
            $banner = $this->request->data['Banner']['imagen'];
            $this->request->data['Actividad']['imagen'] = "";
            if ($banner['name']!=""){
                $unitario = $banner;
                $filename = getcwd()."/img/banners/".$unitario['name'];
                move_uploaded_file($unitario['tmp_name'],$filename);
                $ruta = "/img/banners/".$unitario['name'];
                $this->request->data['Banner']['imagen'] = $ruta;
            }
			/* $res = preg_replace('/[0-9\@\;\" "\!\#\$\%\^\&\*\(\)\+\=]+/', '', $banner['name']);
			$unitario = $banner;
			$filename = getcwd()."/img/banners/".$res;
			move_uploaded_file($banner['name'],$res);
			$ruta = "/img/banners/".$res;
			$this->request->data['Banner']['imagen'] = $ruta; */
		
			/* $this->response->type('json');
			$this->response->body($res);
			return $this->response; */
            if($this->Banner->save($this->request->data)){
                $this->Session->setFlash(__('El Banner ha sido cargado exitosamente', true), 'default' ,array('class'=>'success'));
                $this->redirect(array('action' => 'index','controller'=>'banners')); 
            }
        }
    }
}
?>