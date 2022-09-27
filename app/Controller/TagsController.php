<?php

class TagsController extends AppController{
    public $helpers = array ('Html','Form'); 

    var $name = 'Tags';

    public function add_tag(){
        $campo=array(
            'nombre'=>$this->request->data('nombre')
        );
        if ($this->Tag->save($campo)) {
            $obj= true;
        }else{
            $obj = false;
        }
        
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function ver_datos(){
        $obj = $this->Tag->find('all');
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function ver_datos2(){
        $id = $this->request->data('Id');
        $obj = $this->Tag->find('all', array('conditions'=>array('Id'=>$id)));
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
 
    public function edit() {
		$id=$this->request->data('Id');
		$nombre = $this->request->data('nombre');
			//'Id'=>$this->request->data('Id')
		
		$query = $this->Tag->query('UPDATE tags set nombre = "'.$nombre.'" where Id = '.$id);

		if($query){
			$obj=true;
		}else{
			$obje=false;
		}

		$this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
         
    }

    public function delete() {
        $id = $this->request->data('Id');
            if ($this->Tag->delete($id)){
                $obj=true;

            }else{
                $obj=false;
            }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function argegaTP(){
        $this->loadModel('TagsProductos');
        $campo=array(
            'producto_id'=>$this->request->data('producto_id'),
            'tag_id'=>$this->request->data('tag_id')
        );
        $valida = $this->TagsProductos->find('count', array('conditions'=>array('producto_id = '=>$campo['producto_id'], 'tag_id = '=>$campo['tag_id'])));

        if($valida >0 ){
            $obj['mensaje'] = 'ya hay mas de uno papu';
            $obj= false;
        }else{

            if ($this->TagsProductos->save($campo)) {
                $obj= true;
            }else{
                $obj = false;
                $obj['mensaje'] = 'ya hay mas de uno papu';
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function crear_tags(){
        $this->loadModel('TagsProductos');
        $producto_id = $this->request->data('producto_id');
            
        $obj = $this->TagsProductos->query('SELECT tags_productos.id, tag_id, tags.nombre, producto_id from tags_productos INNER JOIN productos on productos.id = tags_productos.producto_id INNER JOIN tags on tags.id = tags_productos.tag_id WHERE producto_id ='.$producto_id);
        
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function borrar_tag() {
        $this->loadModel('TagsProductos');
        $id = $this->request->data('id');
            if ($this->TagsProductos->delete($id)){
                $obj=true;

            }else{
                $obj=false;
            }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
}

?>