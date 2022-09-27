<?php
class NewslettersController extends AppController {
    
    var $name = 'Newsletters';

    public function add(){
        if ($this->request->is('post')){
            if ($this->Newsletter->save($this->request->data)){
                $this->Session->setFlash('Bienvenido a la comunidad duki. Pronto recibirás noticias, recetas y mucho más','default',array('class'=>'success'));
            }else{
                $this->Session->setFlash('No pudimos registrar tu correo en nuestra base de datos. Favor de intentarlo de nuevo.','default',array('class'=>'error'));
            }
            $this->redirect(array('action' => 'home','controller'=>'pages'));
        }
    }

    public function index(){
        $this->layout='admin';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->set('newsletters',$this->Newsletter->find('all',array('fields'=>array('DISTINCT(correo_electronico) AS correo_electronico'))));
    }

}
?>