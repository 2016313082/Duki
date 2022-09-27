<?php

class CpsController extends AppController {

    public $helpers = array('Js');
    var $name = 'Cps';

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('traer_cps','cookies','ver_datos','cps_view','add_cp','delete','edit','ver_datos_2'));
    }
  

    public function traer_cps(){
        $this->loadModel('NuevosCps');
        $buscador_cp = $this->request->data('buscador_cp');
        $obj['Cps_contar'] = $this->Cp->query('SELECT COUNT(*) as num_result FROM cps where cp like "%'.$buscador_cp.'%" OR colonia like "%'.$buscador_cp.'%" OR municipio like "%'.$buscador_cp.'%"');
        
        if($obj['Cps_contar'][0][0]['num_result'] >= 1){
            $res['Cps'] = $this->Cp->query('SELECT * FROM cps where cp like "%'.$buscador_cp.'%" OR colonia like "%'.$buscador_cp.'%" OR municipio like "%'.$buscador_cp.'%"');
            $res['resultado'] = true;
        }else{
            $campos=array(
                'cp'=>$buscador_cp, 
                'fecha'=>date("Y-m-d H:i:s")
            );
            if($this->NuevosCps->save($campos)){

            }
            $res['resultado'] = false;

        }
        
        $this->response->type('json');
        $this->response->body(json_encode($res));
        return $this->response;
    }

    public function cookies(){
        $resultado = $this->request->data('resultado_cp');
        $obj = $this->Cp->query('SELECT id, cp, colonia from cps where id = '.$resultado);

        $cookie_name = "id_cp";
        $obj['id'] =  $obj[0]['cps']['id'];
        setcookie($cookie_name, $obj[0]['cps']['id'], time() + (60*60*24*365), "/");

        $cookie_name = "Codigo_postal";
        $obj['cp'] = $obj[0]['cps']['cp'];
        setcookie($cookie_name, $obj[0]['cps']['cp'], time() + (60*60*24*365), "/" ); // 86400 = 1 day

        $cookie_name = "Colonia";
        $obj['colonia'] =  $obj[0]['cps']['colonia'];
        setcookie($cookie_name, $obj[0]['cps']['colonia'], time() + (60*60*24*365), "/"); // 86400 = 1 day

        $obj['resultado'] = true;

        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
	
	public function cps_view(){
        $this->layout='admin';
        $this->view='cps';
        if(!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
    }

    public function ver_datos(){
        $obj = $this->Cp->find('all');
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function ver_datos_2(){
        $id = $this->request->data('id');
        $obj = $this->Cp->find('all', array('conditions'=>array('id'=>$id)));
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function edit(){
        $campos = array(
            'id' => $this->request->data('id'),
            'cp' => $this->request->data('cp'),
            'colonia' => $this->request->data('colonia'),
            'municipio' => $this->request->data('municipio'),
            'estado' => $this->request->data('estado')
        );
        if($this->Cp->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }

        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function add_cp(){
        $campos = array(
            'cp' => $this->request->data('cp'),
            'colonia' => $this->request->data('colonia'),
            'municipio' => $this->request->data('municipio'),
            'estado' => $this->request->data('estado')
        );
        if($this->Cp->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function delete(){
        $id = $this->request->data('id');
            if($this->Cp->delete($id)){
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