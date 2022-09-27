<?php
class ProductosController extends AppController {
    
    var $name = 'Productos';

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('buscar','buscar_producto','traer_productos'));
    }
	
	public function info(){
		$obj = $this->Producto->query('SELECT productos.sku, productos.nombre ,cantidad_enviada,cantidad_solicitada,unidad_solicitada,(monto_solicitado + iva_solicitado + ieps_solicitado) as precio_final, pedidos.status, CONCAT(users.nombres, " " , users.apellido_paterno) as nombre_completo ,fecha_pedido,direccion_adicional as colonia,pedidos.id as id_pedido from `productos` INNER JOIN pedidos_productos on productos.id = pedidos_productos.producto_id INNER JOIN pedidos on pedidos.id = pedidos_productos.pedido_id INNER JOIN users on pedidos.user_id = users.id order by user_id desc');
		$this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
	}
	
	public function reporte_finanzas(){
		$obj = $this->Producto->query('SELECT id, nombre_pedido, fecha_entrega, (subtotal + iva + ieps + envio - descuento) as monto, if(forma_pago=1, "efectivo a la entrega", "tarjeta a la entrega") as forma_pago FROM metus973_duki.pedidos where status =6 and fecha_entrega>=date("2022-01-01") and email_contacto not like "%@getnada.com%" order by fecha_entrega desc;');
		$this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
	}

    function sincronizar(){
        $this->getProductos();
        //$this->getCategories();
        $this->Session->setFlash("Se ha actualizado desde Dolibarr exitosamente", 'default' ,array('class'=>'success'));
        $this->redirect(array('action' => 'index','controller'=>'productos'));
    }

    function getProductos(){
        $this->Producto->query("UPDATE productos SET activo = 0, inventario = 0");
        
        $this->loadModel('InventariosDoli');
        $inventarios = $this->InventariosDoli->find('all',array('order'=>'InventariosDoli.fk_entrepot ASC','conditions'=>array('InventariosDoli.fk_entrepot'=>$this->almacenDuki)));
        $inventarios_arreglo = array();
        foreach($inventarios as $inventario){
            $inventarios_arreglo[$inventario['InventariosDoli']['fk_product']] = $inventario['InventariosDoli']['reel'];
        }
        $this->set('listProductos',$inventarios);
        
        $listProduits = [];
		//el 5 es el numero de almacen, cambia por sucursal
        $produitParam = ["sortfield" => "rowid","limit"=>"-1","sqlfilters" => "rowid in (select fk_product from metus973_dolibarr.llxtm_product_stock where fk_entrepot = 5)"];
        // $login = $this->callAPI("GET", $apiKey, $this->apiUrl."login", $this->credenciales);
        // $login = json_decode($login, true);
        
        $listProduitsResult = $this->callAPI("GET", $this->apiKey, $this->apiUrl."products", $produitParam);
        $listProduitsResult = json_decode($listProduitsResult, true);

        if (isset($listProduitsResult["error"]) && $listProduitsResult["error"]["code"] >= "300") {
        } else {
            foreach ($listProduitsResult as $produit) {
                $producto = array(
                    'id'=>$produit['id'],
                    'nombre'=>$produit['label'],
                    'precio_venta'=>$produit['price'],
                    'tasa_iva'=>$produit['tva_tx'],
                    'activo'=>1,
                    'inventario'=>(isset($inventarios_arreglo[$produit['id']]) ? $inventarios_arreglo[$produit['id']] : 0),
					'tasa_ieps'=>$produit['localtax1_tx'],
					'sku'=>$produit['ref']
                );
                $this->Producto->create();
                $this->Producto->save($producto);

            }
        }
        
    }
	
	function buscar(){
        if($this->request->is('post')){
            $conditions = array(
                'OR'=>array(
                    'Producto.nombre LIKE "%'.strtoupper($this->request->data['Producto']['searchstring']).'%"',
                    'Producto.nombre LIKE "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%"',
                ),
                'AND'=>array(
                    'Producto.activo = 1',
                    'Producto.inventario > 0',
                    'Producto.unidad_principal IS NOT NULL',
                    'Producto.precio_venta >'=>0,
					'Producto.id IN (SELECT producto_id FROM productos_categorias)'
                )
            );
            $productos = $this->Producto->query('SELECT * FROM `metus973_duki`.`productos` AS `Producto` INNER JOIN productos_categorias as ProductosCategoria on Producto.id = ProductosCategoria.producto_id WHERE ((`Producto`.`nombre` LIKE "%'.strtoupper($this->request->data['Producto']['searchstring']).'%") OR (`Producto`.`nombre` LIKE "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%")) AND ((`Producto`.`activo` = 1) AND (`Producto`.`inventario` > 0) AND (Producto.conversion > 0) AND (`Producto`.`unidad_principal` IS NOT NULL) AND (`Producto`.`precio_venta` > 0) AND (`Producto`.`id` IN (SELECT producto_id FROM productos_categorias))) group by Producto.id');
            $tag_count = $this->Producto->query('SELECT count(*) as total_tag from tags where nombre like "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%"');
            if($tag_count[0][0]['total_tag'] >0){
                $tag = $this->Producto->query('SELECT * from tags where nombre like "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%"');
                $todos = $this->Producto->query('SELECT * from productos as Producto inner join productos_categorias as ProductosCategoria on ProductosCategoria.producto_id = Producto.id WHERE producto_id in (SELECT producto_id from tags_productos WHERE tag_id ='.$tag[0]['tags']['Id'].' ) AND inventario > 0 AND activo = 1 AND conversion > 0 AND precio_venta > 0 AND unidad_principal IS NOT NULL group by Producto.id;');
                foreach($todos as $producto){
                    array_push($productos,$producto);
                }               
            }
            $this->set('productos',$productos);
            $this->set('searchstring',$this->request->data['Producto']['searchstring']);
            $this->set('searchstring_encode',utf8_encode($this->request->data['Producto']['searchstring']));
			
			if(empty($productos)){
                $this->Producto->query("INSERT INTO busquedas VALUES(0,'".$this->request->data['Producto']['searchstring']."',NOW(),".sizeof($productos).")");
            }
        }
    }

    /* function buscar(){
        if($this->request->is('post')){
            $conditions = array(
                'OR'=>array(
                    'Producto.nombre LIKE "%'.strtoupper($this->request->data['Producto']['searchstring']).'%"',
                    'Producto.nombre LIKE "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%"',
                ),
                'AND'=>array(
                    'Producto.activo = 1',
                    'Producto.inventario > 0',
                    'Producto.unidad_principal IS NOT NULL',
                    'Producto.precio_venta >'=>0,
					'Producto.id IN (SELECT producto_id FROM productos_categorias)'
                )
            ); 
			$productos = $this->Producto->query('SELECT * FROM `metus973_duki`.`productos` AS `Producto` INNER JOIN productos_categorias as ProductosCategoria on Producto.id = ProductosCategoria.producto_id WHERE ((`Producto`.`nombre` LIKE "%'.strtoupper($this->request->data['Producto']['searchstring']).'%") OR (`Producto`.`nombre` LIKE "%'.strtoupper(utf8_encode($this->request->data['Producto']['searchstring'])).'%")) AND ((`Producto`.`activo` = 1) AND (`Producto`.`inventario` > 0.5) AND (Producto.conversion > 0) AND (`Producto`.`unidad_principal` IS NOT NULL) AND (`Producto`.`precio_venta` > 0) AND (`Producto`.`id` IN (SELECT producto_id FROM productos_categorias))) group by Producto.id');
            // if($this->request->data['Producto']['categoria']!=""){
            //     array_push($conditions,array("Producto.id IN (SELECT producto_id FROM productos_categorias WHERE categoria_id = ".$this->request->data['Producto']['categoria'].")"));
            // }
            //$productos = $this->Producto->find('all',array('conditions'=>$conditions));
            $this->set('productos',$productos);
            $this->set('searchstring',$this->request->data['Producto']['searchstring']);
            $this->set('searchstring_encode',utf8_encode($this->request->data['Producto']['searchstring']));

            if(empty($productos)){
                $this->Producto->query("INSERT INTO busquedas VALUES(0,'".$this->request->data['Producto']['searchstring']."',NOW(),".sizeof($productos).")");
            }
        }
    } */


    function getCategories(){
        $listCategories = [];
        $produitParam = ["include_childs" => true];
        $catParam = ["type" => 'product'];
        $listCategories = $this->callAPI("GET", $this->apiKey, $this->apiUrl."categories/87", $produitParam);
        $listCategories = json_decode($listCategories, true);

        $this->loadModel('Categoria');
        if (isset($listCategories["error"]) && $listCategories["error"]["code"] >= "300") {
        } else {
            $this->Producto->query("TRUNCATE TABLE productos_categorias");
            foreach ($listCategories['childs'] as $cat) {
                $categoria = array(
                    'id'=>$cat['id'],
                    'nombre'=>$cat['label'],
                );
                $this->Categoria->create();
                $this->Categoria->save($categoria);

                //Asignar productos por categoria
                $productos_categorias = $this->callAPI("GET", $this->apiKey, $this->apiUrl."categories/".$cat['id']."/objects", $catParam);
                $listprodcat = json_decode($productos_categorias, true);
                foreach($listprodcat as $pc){
                    $this->Producto->query("INSERT INTO productos_categorias VALUES (0,".$cat['id'].",".$pc['id'].",0,0)");
                }
            }
        }
    }

    function index(){
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

        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->layout='admin';
        $this->Producto->Behaviors->load('Containable');
        $this->set(
            'productos',
            $this->Producto->find(
                'all',
                array(
                    'fields'=>array(
                        'id','nombre','precio_venta','unidad_principal','unidad_secundaria','conversion','fotografia','inventario','sku','etiqueta'
                    ),
                    'conditions'=>array(
                        'Producto.activo'=>1
                    ),
                    'contain'=>false
                )
            )
        );
    }

    function pagar(){
        require_once 'HTTP/Request2.php';
        $request = new HTTP_Request2();
        $request->setUrl('https://sandbox.pagofacil.tech//Wsrtransaccion/index/format/json?');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
        'follow_redirects' => TRUE
        ));
        $request->addPostParameter(array(
        'method' => 'transaccion',
        'data[nombre]' => 'CESAR IVAN',
        'data[apellidos]' => 'PINEDA GARCIA',
        'data[numeroTarjeta]' => '5256780300885198',
        'data[cvt]' => '685',
        'data[cp]' => '10500',
        'data[mesExpiracion]' => '05',
        'data[anyoExpiracion]' => '26',
        'data[monto]' => '1.00',
        'data[idSucursal]' => '9f4bb771ceb195111b44e7a689e7dfe60089b288',
        'data[idUsuario]' => 'd07882474f095940361352a8c380cab66fdd1282',
        'data[idServicio]' => '3',
        'data[email]' => 'cesari.pineda@gmail.com',
        'data[telefono]' => '5540547666',
        'data[celular]' => '5540547666',
        'data[calleyNumero]' => '2A CERRADA DE TANTOCO 6',
        'data[colonia]' => 'BARRIO SAN FRANCISCO',
        'data[municipio]' => 'LA MAGDALENA CONTRERAS',
        'data[estado]' => 'CDMX',
        'data[pais]' => 'MEXICO',
        'data[idPedido]' => '1',
        
        ));
        try {
        $response = $request->send();
        if ($response->getStatus() == 200) {
            echo $response->getBody();
        }
        else {
            echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
            $response->getReasonPhrase();
        }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function pagar2(){
        $curl = curl_init();
        $datos_transaccion = array(
            'method' => 'transaccion',
            'data[nombre]' => 'Jon',
            'data[apellidos]' => 'Snow',
            'data[numeroTarjeta]' => '5513 5509 9409 2123',
            'data[cvt]' => '271',
            'data[cp]' => '48219',
            'data[mesExpiracion]' => '08',
            'data[anyoExpiracion]' => '22',
            'data[monto]' => '1599',
            'data[idSucursal]' => 'e147ee31531d815e2308d6d6d39929ab599deb98',
            'data[idUsuario]' => 'f541b3f11f0f9b3fb33499684f22f6d711f2af58',
            'data[idServicio]' => '3',
            'data[email]' => 'pruebas@pagofacil.net',
            'data[telefono]' => '55751875',
            'data[celular]' => '5530996234',
            'data[calleyNumero]' => 'Valle del Don',
            'data[colonia]' => 'Del Valle',
            'data[municipio]' => 'Tecamac',
            'data[estado]' => 'Sonora',
            'data[pais]' => 'México',
            'data[idPedido]' => '1',  
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.pagofacil.tech//Wsrtransaccion/index/format/json?',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $datos_transaccion,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
            
        //$auth_response = json_decode($auth,true);
    }

    function callAPI($method, $apikey, $url, $data = false)
    {
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

    function view($id = null){
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
        $this->layout='admin';
        if($this->request->is('post')){
            if ($this->request->data['Producto']['conversion']!=""){
                $this->request->data['Producto']['conversion'] = 1/$this->request->data['Producto']['conversion'];
            }
            if ($this->request->data['Producto']['fotografia']['name']!=""){
                $unitario = $this->request->data['Producto']['fotografia'];
                $filename = getcwd()."/img/productos/".$unitario['name'];
                move_uploaded_file($unitario['tmp_name'],$filename);
                $ruta = "/img/productos/".$unitario['name'];
                $this->request->data['Producto']['fotografia'] = $ruta;
            }else{
                unset($this->request->data['Producto']['fotografia']);
            }

            if ($this->request->data['Producto']['fotografia_2']['name']!=""){
                $unitario = $this->request->data['Producto']['fotografia_2'];
                $filename = getcwd()."/img/productos/".$unitario['name'];
                move_uploaded_file($unitario['tmp_name'],$filename);
                $ruta = "/img/productos/".$unitario['name'];
                $this->request->data['Producto']['fotografia_2'] = $ruta;
            }else{
                unset($this->request->data['Producto']['fotografia_2']);
            }

            if ($this->request->data['Producto']['fotografia_3']['name']!=""){
                $unitario = $this->request->data['Producto']['fotografia_3'];
                $filename = getcwd()."/img/productos/".$unitario['name'];
                move_uploaded_file($unitario['tmp_name'],$filename);
                $ruta = "/img/productos/".$unitario['name'];
                $this->request->data['Producto']['fotografia_3'] = $ruta;
            }else{
                unset($this->request->data['Producto']['fotografia_3']);
            }

            if($this->Producto->save($this->request->data['Producto'])){
                $this->Session->setFlash(__('El Producto ha sido modificado exitosamente', true), 'default' ,array('class'=>'success'));
                $this->redirect(array('action' => 'index','controller'=>'productos')); 
            }
        }else{
            $this->set('producto',$this->Producto->read(null,$id));
        }
    }
	
	public function edit(){
        $campos = array(
            'id' => $this->request->data('id'),
            'unidad_principal' => $this->request->data('unidad_principal'),
            'unidad_secundaria' => $this->request->data('unidad_secundaria'),
            'conversion' => $this->request->data('conversion'),
            'etiqueta' => $this->request->data('etiqueta')
        );
        if($this->Producto->save($campos)){
            $obj = true;
        }else{
            $obj = false;
        }

        //$obj = $this->request->data;
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
	
	public function agregar_producto(){
        $this->loadModel('ProductoCategorias');
        $query = $this->ProductoCategorias->find('count',array('conditions'=>array('categoria_id'=>104,'producto_id'=>$this->request->data('producto_id'))));
        $campos = array(
            'categoria_id'=>$this->request->data('categoria_id'),
            'producto_id'=>$this->request->data('producto_id')
        );
        if($query > 0){
            $obj = false;
        }else{
            if($this->ProductoCategorias->save($campos)){
                $obj = true;
            }else{
                $obj = false;
            }
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }

    public function traer_mercadito(){
        $query = $this->Producto->find('all',array('conditions'=>array('`Producto`.`id` IN (select producto_id from productos_categorias where categoria_id = 104) order by Producto.id desc')));
        $this->response->type('json');
        $this->response->body(json_encode($query));
        return $this->response;
    }

    public function eliminar_mercadito(){
        $this->loadMOdel('ProductoCategorias');
        $id = $this->request->data('id');
        if($this->ProductoCategorias->deleteAll(array('categoria_id'=>104,'producto_id'=>$id))){
            $obj = true;
        }else{
            $obj = false;
        }
        $this->response->type('json');
        $this->response->body(json_encode($obj));
        return $this->response;
    }
	
	public function promociones_view(){
        $this->layout= 'admin';
        $this->view='promociones_view';
        if (!$this->Session->read('Auth.User.interno')){
            $this->redirect(array('controller'=>'pages','action'=>'home'));
        }
    }
	
	public function buscar_producto(){
        $producto = $this->request->data('producto');
        $query = $this->Producto->find('all',array('conditions'=>array(
            'id in (SELECT producto_id from productos_categorias where categoria_id = 104 or categoria_id = 88 or categoria_id = 89 or categoria_id = 96 or categoria_id = 93)',
        ),'contain'=>false));
        $this->response->type('json');
        $this->response->body(json_encode($query));
        return $this->response;
    }
	
}
?>