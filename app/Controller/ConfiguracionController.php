<?php
class ConfiguracionController extends AppController {
    var $name = 'Configuracion';
    public function configuracion_view(){
        $this->layout='admin';
        $this->view='configuracion';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
    }

    public function traer_dias(){
        $this->loadModel('DiasHorario');
        $obj = $this->DiasHorario->query('SELECT * FROM dias');
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function traer_horarios(){
        $id_dia = $this->request->data('id_dia');
        $this->loadModel('DiasHorario');
        $obj = $this->DiasHorario->query('select * from horarios inner join dias_horarios on horarios.id = dias_horarios.horario_id where dias_id = '.$id_dia);
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    } 

    public function traer_horario(){
        $id = $this->request->data('id');
        $this->loadModel('DiasHorario');
        $obj = $this->DiasHorario->query('select * from horarios where id ='.$id);
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function editar_horario(){
        $this->loadModel('Horario');
        $campos = array(
            'id' => $this->request->data('id'),
            'nombre' => $this->request->data('nombre'),
            'hora_limite' => $this->request->data('tiempo')
        );
        //$obj = 'hola';
        if($this->Horario->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function cambiar_status(){
        $id = $this->request->data('id');
        $this->loadModel('DiasHorario');
        $this->loadModel('Dia');
        $objeto = $this->DiasHorario->query('select * from dias where id ='.$id);
        if($objeto[0]['dias']['status'] == 1){
            $campos = array(
                'id' => $this->request->data('id'),
                'status' => 0
            ); 
        }else{
            $campos = array(
                'id' => $this->request->data('id'),
                'status' => 1
            ); 
        }
        if($this->Dia->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }

        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
}