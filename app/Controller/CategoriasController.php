<?php
class CategoriasController extends AppController {
    
    var $name = 'Categorias';

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('view','prueba','recargar_productos','traer_categorias','traer_subcategorias1_categorias','traer_subcategorias2_categorias','matriz_categorias','cargar_subcategorias','cargar_subcategoriasDos','matriz_categorias'));
    }

    public function view($id = null,$orden=null,$pagina = 1){
        $this->Categoria->Behaviors->load('Containable');
        $orden_conditions = array('Productos.id DESC');
        if(isset($orden)){
            switch($orden){
                case(1): // A-Z
                    $orden_conditions = array('Productos.nombre ASC');
                break;
                case(2): // Z-A
                    $orden_conditions = array('Productos.nombre DESC');
                break;
                case(3): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta ASC');
                break;
                case(4): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta DESC');
                break;
                case(5): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.id DESC');
                break;
            }
            $this->set('orden',$orden);
        }
        
        $categoria['categoria'] = $this->Categoria->find(
            'first',
            array(
                'conditions'=>array(
                    'Categoria.id'=>$id,
                ),
                'contain'=>array(
                    'Productos'=>array(
                        'order'=>$orden_conditions,
                        'limit'=>$pagina*12
                    )
                )
            )
        );
        $nuevo_id = [];
        $contador = 0;
        foreach($categoria['categoria']['Productos'] as $producto){
            $categorias = $this->Categoria->query('SELECT * FROM productos_categorias where producto_id = '.$producto['id']);
            foreach($categorias as $producto_categoria){
                if($producto_categoria['productos_categorias']['categoria_id'] == $id){
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }else{
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }
                
            }
            $contador++;
        }
        $this->set($categoria); 
    }

    public function cargar_subcategoriasDos(){
        $this->loadModel('SubcategoriaDos');
        $pagina = $this->request->data('pagina');
        $id = $this->request->data('subcategoriaDos_id');
        //$this->Categoria->Behaviors->load('Containable');
        $orden_conditions = array('Productos.id DESC');
        if(isset($orden)){
            switch($orden){
                case(1): // A-Z
                    $orden_conditions = array('Productos.nombre ASC');
                break;
                case(2): // Z-A
                    $orden_conditions = array('Productos.nombre DESC');
                break;
                case(3): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta ASC');
                break;
                case(4): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta DESC');
                break;
                case(5): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.id DESC');
                break;
            }
            $categoria['orden'] = $orden;
        }
        
        $categoria['categoria'] = $this->SubcategoriaDos->find(
            'first',
            array(
                'conditions'=>array(
                    'id'=>$id,
                ),
                'contain'=>array(
                    'Productos'=>array(
                        'order'=>$orden_conditions,
                        //'limit'=>$pagina*12
                    )
                )
            )
        );
        $nuevo_id = [];
        $contador = 0;
        foreach($categoria['categoria']['Productos'] as $producto){
            $categorias = $this->Categoria->query('SELECT * FROM productos_categorias where producto_id = '.$producto['id']);
            foreach($categorias as $producto_categoria){
                if($producto_categoria['productos_categorias']['categoria_id'] == $id){
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }else{
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }
                
            }
            $contador++;
        }
        $this->response->type('json');
		$this->response->body(json_encode($categoria));
		return $this->response;
    }

    public function cargar_subcategorias(){
        $this->loadModel('Subcategoria');
        $pagina = $this->request->data('pagina');
        $id = $this->request->data('subcategoria_id');
        $this->Categoria->Behaviors->load('Containable');
        $orden_conditions = array('Productos.id DESC');
        if(isset($orden)){
            switch($orden){
                case(1): // A-Z
                    $orden_conditions = array('Productos.nombre ASC');
                break;
                case(2): // Z-A
                    $orden_conditions = array('Productos.nombre DESC');
                break;
                case(3): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta ASC');
                break;
                case(4): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta DESC');
                break;
                case(5): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.id DESC');
                break;
            }
            $categoria['orden'] = $orden;
        }
        
        $categoria['categoria'] = $this->Subcategoria->find(
            'first',
            array(
                'conditions'=>array(
                    'id'=>$id,
                ),
                'contain'=>array(
                    'Productos'=>array(
                        'order'=>$orden_conditions,
                        //'limit'=>$pagina*12
                    )
                )
            )
        );
        $nuevo_id = [];
        $contador = 0;
        foreach($categoria['categoria']['Productos'] as $producto){
            $categorias = $this->Categoria->query('SELECT * FROM productos_categorias where producto_id = '.$producto['id']);
            foreach($categorias as $producto_categoria){
                if($producto_categoria['productos_categorias']['categoria_id'] == $id){
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }else{
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }
                
            }
            $contador++;
        }
        $this->response->type('json');
		$this->response->body(json_encode($categoria));
		return $this->response;
    }

    public function recargar_productos($id = null,$orden=null,$pagina = 1){
        $pagina = $this->request->data('pagina');
        $this->Categoria->Behaviors->load('Containable');
        $orden_conditions = array('Productos.id DESC');
        if(isset($orden)){
            switch($orden){
                case(1): // A-Z
                    $orden_conditions = array('Productos.nombre ASC');
                break;
                case(2): // Z-A
                    $orden_conditions = array('Productos.nombre DESC');
                break;
                case(3): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta ASC');
                break;
                case(4): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.precio_venta DESC');
                break;
                case(5): // PRECIO BAJO A ALTO
                    $orden_conditions = array('Productos.id DESC');
                break;
            }
            $categoria['orden'] = $orden;
        }
        
        $categoria['categoria'] = $this->Categoria->find(
            'first',
            array(
                'conditions'=>array(
                    'Categoria.id'=>$id,
                ),
                'contain'=>array(
                    'Productos'=>array(
                        'order'=>$orden_conditions,
                        'limit'=>$pagina*12
                    )
                )
            )
        );
        $nuevo_id = [];
        $contador = 0;
        foreach($categoria['categoria']['Productos'] as $producto){
            $categorias = $this->Categoria->query('SELECT * FROM productos_categorias where producto_id = '.$producto['id']);
            foreach($categorias as $producto_categoria){
                if($producto_categoria['productos_categorias']['categoria_id'] == $id){
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }else{
                    array_push($categoria['categoria']['Productos'][$contador]['productos_categorias'],array('segunda_categoria'=>$producto_categoria['productos_categorias']['categoria_id']));
                }
                
            }
            $contador++;
        }
        $this->response->type('json');
		$this->response->body(json_encode($categoria));
		return $this->response;
    }

    public function categorias_view(){
        $this->layout='admin';
        $this->view='index';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
    }

    public function traer_categorias(){
        $obj = $this->Categoria->find('all');
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function agregar_categoria(){
        $categoria = $this->request->data;
        if($this->Categoria->save($categoria)){ 
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategorias1(){
        $this->loadModel('Subcategoria');
        $obj = $this->Subcategoria->find('all');
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategorias1_categorias(){
        $this->loadModel('Subcategoria');
        $categoria_id = $this->request->data('categoria_id');
        $obj['subcategorias'] = $this->Subcategoria->find('all',array('conditions'=>array('id_categoria'=>$categoria_id)));
        $obj['categoria'] = $this->Categoria->find('all',array('conditions'=>array('id'=>$categoria_id)));
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategorias2_categorias(){
        $this->loadModel('SubcategoriaDos');
        $this->loadModel('Subcategoria');
        $subcategoria_id = $this->request->data('subcategoria_id');
        $obj['subcategoriasDos'] = $this->SubcategoriaDos->find('all',array('conditions'=>array('id_subcategoria'=>$subcategoria_id)));
        $obj['subcategoria'] = $this->Subcategoria->find('all',array('conditions'=>array('id'=>$subcategoria_id)));
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function matriz_categorias(){
        $categoria_id = $this->request->data('categoria_id');
        $obj = $this->Categoria->query('select * from categorias inner join subcategorias on categorias.id = subcategorias.id_categoria inner join subcategorias2 on subcategorias.id = subcategorias2.id_subcategoria where categorias.id = '.$categoria_id.' order by subcategorias2.id_subcategoria');
        //$obj['grupo'] = $this->Categoria->query('select * from categorias inner join subcategorias on categorias.id = subcategorias.id_categoria inner join subcategorias2 on subcategorias.id = subcategorias2.id_subcategoria where categorias.id = '.$categoria_id.' group by subcategorias.id');
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategorias2(){
        $this->loadModel('SubcategoriaDos');
        $obj = $this->SubcategoriaDos->find('all');
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function eliminar_categoria(){
        $id = $this->request->data;
        if($this->Categoria->delete($id)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_categoria(){
        $id = $this->request->data;
        $obj = $this->Categoria->find('first',array('conditions'=>array('id'=>$id)));
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function editar_categoria(){
        $campos = array(
            'id' => $this->request->data('id'),
            'nombre' => $this->request->data('nombre')
        );
        if($this->Categoria->save($campos)){ 
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function agregar_subcategoria(){
        $campos = $this->request->data;
        $this->loadModel('Subcategoria');
        if($this->Subcategoria->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function eliminar_subcategoria(){
        $id = $this->request->data;
        $this->loadModel('Subcategoria');
        if($this->Subcategoria->delete($id)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategoria(){
        $id = $this->request->data;
        $this->loadModel('Subcategoria');
        $obj = $this->Subcategoria->find('first',array('conditions'=>array('id'=>$id)));
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function editar_subcategoria(){
        $campos = $this->request->data;
        $this->loadModel('Subcategoria');
        if($this->Subcategoria->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }
	
	public function editar_subcategoria_2(){
		$campos = $this->request->data;
        $this->loadModel('SubcategoriaDos');
        if($this->SubcategoriaDos->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
	}	

    public function agregar_subcategoriaDos(){
        $campos = $this->request->data;
        $this->loadModel('SubcategoriaDos');
        if($this->SubcategoriaDos->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function eliminar_subcategoriaDos(){
        $id = $this->request->data;
        $this->loadModel('SubcategoriaDos');
        if($this->SubcategoriaDos->delete($id)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function traer_subcategoriaDos(){
        $id = $this->request->data('id');
        $this->loadModel('SubcategoriaDos');
        $obj = $this->SubcategoriaDos->find('first',array('conditions'=>array('id'=>$id)));
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function categorias_productos(){
        $id_producto = $this->request->data('id_producto');
        $query = $this->Categoria->query('SELECT * FROM `productos_categorias`inner join categorias on categorias.id = productos_categorias.categoria_id where producto_id = '.$id_producto);
        $this->response->type('json');
		$this->response->body(json_encode($query));
		return $this->response;
    }

    public function subcategoria_productos(){
        $id_producto = $this->request->data('id_producto');
        $query = $this->Categoria->query('SELECT * FROM `productos_categorias`inner join subcategorias on subcategorias.id = productos_categorias.subcategoria_id where producto_id = '.$id_producto);
        $this->response->type('json');
		$this->response->body(json_encode($query));
		return $this->response;
    }

    public function subcategoria2_productos(){
        $id_producto = $this->request->data('id_producto');
        $query = $this->Categoria->query('SELECT * FROM `productos_categorias`inner join subcategorias2 on subcategorias2.id = productos_categorias.subcategoria2_id where producto_id = '.$id_producto);
        $this->response->type('json');
		$this->response->body(json_encode($query));
		return $this->response;
    }

    public function agregar_producto(){
        $producto_id = $this->request->data('producto_id');
        $categoria_id = $this->request->data('categoria_id');
        $this->loadModel('ProductoCategorias');
        $count = $this->ProductoCategorias->find('count',array('conditions'=>array('producto_id'=>$producto_id,'categoria_id'=>$categoria_id)));
        if($count < 1){
            $query = $this->ProductoCategorias->find('first',array('conditions'=>array('producto_id'=>$producto_id,'categoria_id'=>$categoria_id)));
            $campos = array(
                'id'=>$query['ProductoCategorias']['id'],
                'producto_id'=>$producto_id,
                'categoria_id'=>$categoria_id
            );
            if($this->ProductoCategorias->save($campos)){
                $obj = true;
            }else{
                $obj = false;
            }
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function agregar_producto_sub(){
        $producto_id = $this->request->data('producto_id');
        $subcategoria_id = $this->request->data('subcategoria_id');
        $categoria_id = $this->request->data('categoria_id');
        $this->loadModel('ProductoCategorias');
        $count = $this->ProductoCategorias->find('count',array('conditions'=>array('producto_id'=>$producto_id,'subcategoria_id'=>$subcategoria_id)));
        if($count < 1){
            $query = $this->ProductoCategorias->find('first',array('conditions'=>array('producto_id'=>$producto_id,'categoria_id'=>$categoria_id)));
            $campos = array(
                'id'=>$query['ProductoCategorias']['id'],
				'categoria_id'=>$categoria_id,
                'producto_id'=>$producto_id,
                'subcategoria_id'=>$subcategoria_id
            );
            if($this->ProductoCategorias->save($campos)){
                $obj = true;
            }else{
                $obj = false;
            } 
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function agregar_producto_sub2(){
		$subcategoria_id = $this->request->data('subcategoria_id');
        $producto_id = $this->request->data('producto_id');
        $subcategoria2_id = $this->request->data('subcategoria2_id');
		$categoria_id = $this->request->data('categoria_id');
        $this->loadModel('ProductoCategorias');
        $count = $this->ProductoCategorias->find('count',array('conditions'=>array('producto_id'=>$producto_id,'subcategoria_id'=>$subcategoria2_id)));
        if($count < 1){
            $query = $this->ProductoCategorias->find('first',array('conditions'=>array('producto_id'=>$producto_id,'subcategoria_id'=>$subcategoria_id,'categoria_id'=>$categoria_id)));
            $campos = array(
                'id'=>$query['ProductoCategorias']['id'],
				'categoria_id'=>$query['ProductoCategorias']['categoria_id'],
                'producto_id'=>$producto_id,
				'subcategoria_id'=>$query['ProductoCategorias']['subcategoria_id'],
                'subcategoria2_id'=>$subcategoria2_id
            );
            if($this->ProductoCategorias->save($campos)){
                $obj = true;
            }else{
                $obj = false;
            }
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function eliminar_categoria_producto(){
        $this->loadModel('ProductoCategorias');
        $producto_id = $this->request->data('producto_id');
        $categoria_id = $this->request->data('categoria_id');
        $conditions = array(
            'producto_id'=>$producto_id,
            'categoria_id'=>$categoria_id
        );
        if($this->ProductoCategorias->deleteAll($conditions)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }

    public function eliminar_subcategoria_producto(){
        $this->loadModel('ProductoCategorias');
        $producto_id = $this->request->data('producto_id');
        $subcategoria_id = $this->request->data('subcategoria_id');
        $conditions = array(
            'producto_id'=>$producto_id,
            'subcategoria_id'=>$subcategoria_id
        );
        if($this->ProductoCategorias->deleteAll($conditions)){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
		$this->response->body(json_encode($obj));
		return $this->response;
    }
	
	public function eliminar_subcategoria2_producto(){
        $this->loadModel('ProductoCategorias');
        $producto_id = $this->request->data('producto_id');
        $subcategoria_id = $this->request->data('subcategoria2_id');
        $conditions = array(
            'producto_id'=>$producto_id,
            'subcategoria2_id'=>$subcategoria_id
        );
        if($this->ProductoCategorias->deleteAll($conditions)){
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