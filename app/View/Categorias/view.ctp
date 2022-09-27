<?php 
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if(isset($uri_segments[4])){
        $variable = $uri_segments[4];
    }else{
        $variable = 5;
    }
	$url = $uri_segments[3];
	
?>
<style>
/* body {
  background-color: #fbfbfb;
} */
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}

.color-2{
   background: -webkit-linear-gradient(#006341, #FFFFFF,#C8102E);
    
}
.mobil{
    display: none;
}
main::-webkit-scrollbar {
 display: none;
}

@media (max-width: 480px) {
    .sideba-categorias {
        width: 10%;
        height: 100%;
    }
    .mobil{
        display: block;
    }
    main{
        margin-top: 10%;
    }
}

.lista-padre{
    font-size: 20px;
    color : gray;
}

.lista-padre:hover{
    font-size: 21px;
    color : rgb(79,201,173);
    text-decoration:underline;
}

.lista-hija{
    font-size: 17px;
    color: gray;
}

.lista-hija:hover{
    font-size: 18px;
    color: rgb(78,181,140);
    text-decoration:underline;
}
</style>
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-content">
					<h1 class=""><?= $categoria['Categoria']['nombre']?></h1>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Breadcrumb Area End -->
<!-- Shop Category Area End -->
<div class="shop-category-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Shop Top Area Start -->
                <div class="shop-top-bar">
                    <!-- Left Side start -->
                    <div class="shop-tab nav mb-res-sm-15">
                        <p>Mostrando <?= sizeof($categoria['Productos'])?> productos.</p>
                    </div>
                    <!-- Left Side End -->
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap">
                        <div class="shot-product">
                            <p>Ordenar por:</p>
                        </div>
                        <div class="shop-select">
                            <?php
                                $ordenes = array(
                                    1=>'A - Z',
                                    2=>'Z - A',
                                    3=>'Por precio más bajo',
                                    4=>'Por precio más alto'
                                ); 
                                echo $this->Form->input('orden',array('label'=>false,'type'=>'select','options'=>$ordenes,'onchange'=>'javascript:changeOrder()','class'=>'nice-select','value'=>isset($orden)?$orden:1))?>
                        </div>
                        <script>
                            function changeOrder(){
                                window.location.href = base_url + "categorias/view/"+<?= $categoria['Categoria']['id'] ?>+"/"+document.getElementById('orden').value;
                            }
                        </script>
                    </div>
                    <!-- Right Side End -->
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area mt-35">
                    <div class="tab-content jump">
                        <div id="shop-1" class="d-flex p-2">
                            <div class="d-flex flex-column">
                                <ul class="breadcrumb-links">
                                    <li><i class="fa fa-home" aria-hidden="true"></i> <?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                                    <li><a href="<?= $categoria['Categoria']['id'] ?>"><?= $categoria['Categoria']['nombre']?></a></li>
                                </ul>
                                <select class="form-control mobil" id="select-categorias"></select>
                                <nav id="" class="collapse d-lg-block sidebar-categorias collapse bg-white">
                                    <div class="position-sticky">
                                        <div class="list-group list-group-flush mt-4 dropdown" id="lista-subcategorias"></div>
                                    </div>
                                </nav>
                            </div>
                            <div class="container pt-4" >
                                    <div id="anuncio"></div>
                                    <div class="row" id="articulo" name="ancla"></div>
                            </div>
                        </div>
                        <center><a class="shop-btn animated shadow" id="btn-ver-mas" style="text-align:center;width:35%" onclick="ver_mas();"><font size="4" style="color:white;">Ver mas <i id="flecha" class="fa fa-arrow-down " aria-hidden="true"></i></a></font></center><br>
                        <!-- Tab One End -->
                    </div>
					
                    <!-- Shop Tab Content End -->                                
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Category Area End -->
<script>
	var variable = <?= $variable ?>;
    var url = <?= $url ?>;
	$(window).resize(function(){
        if ($(window).width() < 480) {
            $('#shop-1').removeClass('d-flex');
        } else {
            $('#shop-1').addClass('d-flex');
        }
    });
	
     $(document).ready(function(){
		if(url == 125){
            var content = '<div class="alert color-2" role="alert"><h5 style="color : #000;">Promociones válidas únicamente en el mes de Septiembre. Hasta agotar existencias. <a href="#" onclick="ver_terminos()"><b><span style="color:#000">Términos y condiciones</span></b></a></h5></div>';
            $('#anuncio').html(content);
        }
        var productos = <?= json_encode($categoria['Productos']) ?>;
        articulos(productos);
        cargar_subcategorias(url);
		$('#select-categorias').on('change',function(){
            var id_categoria = $('#select-categorias').val();
            var tipo_categoria = $('option:selected',this).data("categoria");
            if(tipo_categoria == 1){
                subcategorias_productos(id_categoria,1);
            }else{
                subcategorias_productosDos(id_categoria,1);
            }
        });
    });
	
	function cargar_subcategorias(categoria_id){
        var content = '';
        var content_select = '';
        var id_sub = 0;
        var bandera = 0;
        var contador = 0;
        $.ajax({
            'url' : base_url + 'categorias/matriz_categorias',
            'type' : 'post',
            'data' : {'categoria_id':categoria_id},
            'datatype' : 'json',
            'success' : function(obj){
                content += '<ul>';
                content_select += '<option selected disabled>Selecciona una categoria</option>';
                //console.log(obj);
                $.each(obj,function(i,elemento){
					//console.log(elemento.subcategorias.id+' '+id_sub);
                    if(elemento.subcategorias.id == id_sub){
                        bandera = 0;
                    }else{
                        bandera = 1;
                    }  
                    
                    if(bandera == 0){
                        if(elemento.subcategorias2.status == 1 && elemento.subcategorias.status == 1){
                            content_select += '<option data-categoria="2" value="'+elemento.subcategorias2.id+'">'+elemento.subcategorias2.nombre+'</option>';
                            content += '<a href="#" onclick="subcategorias_productosDos('+elemento.subcategorias2.id+','+variable+');"><dd><span class="lista-hija">'+elemento.subcategorias2.nombre+'</span></dd></a>';
                        } 
                            bandera = 1;
                    }else{
						if(elemento.subcategorias.status == 1){
                            content_select += '<option data-categoria="1" style="color:red;" value="'+elemento.subcategorias.id+'">'+elemento.subcategorias.nombre+'</option>';
                            content += '<a href="#" onclick="subcategorias_productos('+elemento.subcategorias.id+','+variable+');"><dt><span class="lista-padre">'+elemento.subcategorias.nombre+'</span></dt></a>'; 
                        } 
                        if(elemento.subcategorias2.status == 1 && elemento.subcategorias.status == 1){
                            content_select += '<option data-categoria="2" value="'+elemento.subcategorias2.id+'">'+elemento.subcategorias2.nombre+'</option>';
                            content += '<ul>' +
                            '<a href="#" onclick="subcategorias_productosDos('+elemento.subcategorias2.id+','+variable+');"><dd><span class="lista-hija">'+elemento.subcategorias2.nombre+'</span></dd></a>';
                        }
                          
                        content += '</ul>';
                    }
                    id_sub = elemento.subcategorias.id;
                });
                //console.log(content);
                $('#lista-subcategorias').html(content);
                $('#select-categorias').prepend(content_select);
            }
        })
    } 
	
	function ver_terminos(){
		$('#modal-terminos').modal('show');
	}
    
	function cargar_subcategorias2(id_subcategoria){
        var content = '';
        var contador = 0;
        $.ajax({
            'url' : base_url + 'categorias/traer_subcategorias2_categoria',
            'type' : 'post',
            'data' : {'subcategoria_id':id_subcategoria},
            'datatype' : 'json',
            'success' : function(obj){
                
            }
        })
    }
	
	function subcategorias_productos(subcategoria_id,pagina){
        //$('#articulo').html('');
        var data = {
            'subcategoria_id' : subcategoria_id,
            'pagina' : pagina
        }

        $.ajax({
            'url' : base_url + 'categorias/cargar_subcategorias',
            'type' : 'post',
            'data' : data,
            'datatype' : 'json',
            'success' : function(obj){
                //console.log(obj.categoria.Productos);
                articulos(obj.categoria.Productos,'#articulo');
            }
        });
		$('#btn-ver-mas').addClass('d-none');
    }
	
	function subcategorias_productosDos(subcategoriaDos_id,pagina){
        var data = {
            'subcategoriaDos_id' : subcategoriaDos_id,
            'pagina' : pagina
        }

        $.ajax({
            'url' : base_url + 'categorias/cargar_subcategoriasDos',
            'type' : 'post',
            'data' : data,
            'datatype' : 'json',
            'success' : function(obj){
                //console.log(obj.categoria.Productos);
                articulos(obj.categoria.Productos,'#articulo');
            }
        });
		$('#btn-ver-mas').addClass('d-none');
    }
	
    function unidad1(unidad_principal,id,inventario,categoria){
        $('#cantidad'+id).inputSpinner('destroy');
        $('#cantidad'+id).removeAttr('step');
        if(categoria == 88 || categoria == 89 || categoria == 96){
            $('#cantidad'+id).attr('step',0.5);
            $('#cantidad'+id).attr('data-decimals',1);
        }
        $('#cantidad'+id).attr('min',1);
		$('#cantidad'+id).attr('max',inventario);
        $('#cantidad'+id).attr('data-prefix',unidad_principal);
        $('#cantidad'+id).val(1);
        $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
        $('#unidad'+id).val(unidad_principal);
    }

    function unidad2(categoria,unidad_secundaria,id,inventario,conversion){
        var inventario_gramos = inventario*1000;
        if(unidad_secundaria == 'Gr'){
            if(categoria == 96 || categoria == 104){
                $('#cantidad'+id).inputSpinner('destroy');
                $('#cantidad'+id).attr('min',500);
                $('#cantidad'+id).attr('max',inventario_gramos);
                $('#cantidad'+id).attr('step',500);
                $('#cantidad'+id).removeAttr('data-decimals');
                $('#cantidad'+id).attr('data-prefix',unidad_secundaria);
                $('#cantidad'+id).val(500);
                $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
                $('#unidad'+id).val(unidad_secundaria);
                //conversion = 0.180;
            }else{
                $('#cantidad'+id).inputSpinner('destroy');
                $('#cantidad'+id).attr('min',100);
                $('#cantidad'+id).attr('step',50);
                $('#cantidad'+id).removeAttr('data-decimals');
                $('#cantidad'+id).attr('max',inventario_gramos);
                $('#cantidad'+id).attr('data-prefix',unidad_secundaria);
                $('#cantidad'+id).val(100);
                $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
                $('#unidad'+id).val(unidad_secundaria);
                //conversion = 0.180;
            }	
        }else{
            var limite_pieza = inventario/conversion; //limite de inventario dependiendo de la conversion de la pieza
            $('#cantidad'+id).inputSpinner('destroy');
            $('#cantidad'+id).removeAttr('min');
            $('#cantidad'+id).removeAttr('step');
            $('#cantidad'+id).attr('min',1);
            $('#cantidad'+id).attr('data-prefix',unidad_secundaria); 
			$('#cantidad'+id).attr('max',limite_pieza);
            $('#cantidad'+id).val(1);
            $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
            $('#unidad'+id).val(unidad_secundaria); 
            //conversion = 0.180;
        }
    }

    function articulos(productos){
        var article = "";
        var precio = 0;
        var categoria = 0;
		var categoria_2 = 0;
        var inventario_gramos = 0;
        $.each(productos,function(i,elemento){
            switch(elemento.unidad_principal){
                case 'Docena':
                    var uni = 'Doc';
                    break;
                case 'Kg':
                    var uni = 'Kg';
                    break;
                case 'Manojo':
                    var uni = 'Mjo';
                    break;
                case 'Pieza':
                    var uni = 'Pza';
                    break;
                //case 'Lt'
            }
            inventario_gramos = elemento.inventario*1000;
            categoria = elemento.productos_categorias.categoria_id;
			categoria_2 = elemento.productos_categorias[0].segunda_categoria;//
			
            precio = elemento.precio_venta*(1+(elemento.tasa_iva/100)+(elemento.tasa_ieps/100));
            //$('#cantidad'+elemento.id).attr('data-prefix',elemento.unidad_principal);
            //$producto['precio_venta']*(1+($producto['tasa_iva']/100)+($producto['tasa_ieps']/100)),2)
            article += '<div class="col-xl-3 col-md-4 col-sm-4">'+
            '<article class="list-product">'+
                '<div class="img-block">' +
                    '<img src="'+base_url+elemento.fotografia+'" class="first-img" alt="DukiMX - '+elemento.nombre+'"/>'+    
                '</div>'+
                '<div class="product-decs">'+
                    '<span style="color:red;"">'+elemento.etiqueta+'</span>'+
                    '<h2 class="product-link">'+elemento.nombre+'</h2>'+
                    '<div class="pricing-meta">'+
                        '<ul>'+ 
                            '<li class="current-price">$'+Number.parseFloat(precio).toFixed(2)+'/'+elemento.unidad_principal+'</li>'+
                        '</ul>'+
                    '</div>'+
                '</div>'+
                '<div class="add-to-link" style="padding:2%">'+
                    '<div class="row">'+
                        '<div class="product-details-content" style="width:100%">'+
                            '<div class="form-row">';

                            if(elemento.inventario < 1 && elemento.unidad_secundaria == 'Gr'){
							//console.log(elemento.nombre + elemento.inventario + elemento.unidad_secundaria + categoria);
								if(categoria == 96 || categoria == 104 && categoria_2 == 96){
									article +='<div class="col-sm-12 col-12">'+
										'<input name="cantidad" class="form-control-sm cantidad" value="500" type="number" min="500" step="500" data-prefix="Gr" max="'+inventario_gramos+'" id="cantidad'+elemento.id+'"/>'+
									'</div>';
								}else{
									article +='<div class="col-sm-12 col-12">'+
										'<input name="cantidad" class="form-control-sm cantidad" value="1" type="number" min="100" step="50" data-prefix="Gr" max="'+inventario_gramos+'" id="cantidad'+elemento.id+'"/>'+
									'</div>';
								}
                            }else if(elemento.inventario < 1 && elemento.unidad_secundaria == 'Pieza'){
                                var limite_pieza = elemento.inventario/elemento.conversion;
                                article +='<div class="col-sm-12 col-12">'+
                                    '<input name="cantidad" class="form-control-sm cantidad" value="1" type="number" min="1" step="1" data-prefix="Pza" max="'+limite_pieza+'" id="cantidad'+elemento.id+'"/>'+
                                '</div>';
                            }else{
                                article += '<div class="col-sm-12 col-12">'+
                                    '<input name="cantidad" class="form-control-sm cantidad" value="1" type="number" min="1" data-prefix="'+uni+'" max="'+elemento.inventario+'" id="cantidad'+elemento.id+'"/>'+
                                '</div>';
                            }
                                '<div class="col-sm-12 col-12">'+
                                    '<input name="cantidad" class="form-control-sm cantidad" value="1" type="number" min="1" max="'+elemento.inventario+'" id="cantidad'+elemento.id+'"/>'+
                                '</div>';
                                    //if para pintar botones
                                    if(elemento.unidad_secundaria == ''){
                                        article += '<input id="unidad'+elemento.id+'" value="'+elemento.unidad_principal+'" hidden>'+
                                        '<div class="col-sm-12 col-12">'+
                                            '<button class="form-control" style="margin-top: 2%;" disabled>'+elemento.unidad_principal+'</button>'+
                                        '</div>';
                                    }else if(elemento.inventario >= 1){
                                        article += '<input id="unidad'+elemento.id+'" value="'+elemento.unidad_principal+'" hidden>'+
                                        '<div class="col-sm-6 col-6">'+
                                            '<button class="form-control unidad" style="margin-top: 2%;" id="unidad1" onclick="unidad1(`'+elemento.unidad_principal+'`,'+elemento.id+','+elemento.inventario+','+categoria+')">'+elemento.unidad_principal+'</button>'+
                                        '</div>'+
                                        '<div class="col-sm-6 col-6">'+
                                            '<button class="form-control unidad2" style="margin-top: 2%;" id="unidad2" onclick="unidad2('+categoria+',`'+elemento.unidad_secundaria+'`,'+elemento.id+','+elemento.inventario+','+elemento.conversion+','+categoria_2+')">'+elemento.unidad_secundaria+'</button>'+
                                        '</div>';
                                    }else{
                                        article += '<div class="col-sm-12 col-12">'+
                                                    '<input id="unidad'+elemento.id+'" value="'+elemento.unidad_secundaria+'" hidden>'+
                                                    '<button class="form-control unidad2" disabled style="margin-top: 2%;" id="unidad2">'+elemento.unidad_secundaria+'</button>'+
                                        '</div>';
                                    }
                            
                                    article +='</div>'+
                                    '</div>';
                                    if(categoria == 88 || categoria == 112 || categoria == 89 && elemento.unidad_principal == 'Kg'){
                                        article += '<input name="data[notas'+elemento.id+']" type="text" placeholder="Notas Adicionales" style="width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;" id="notas'+elemento.id+'"/>';
                                    }else if(categoria == 123 && elemento.id == 2180){
                                        article += '<select class="form-control" style="margin-top: 2%;" id="notas'+elemento.id+'" required>'+
                                        '<option selected disabled value="0">Selecciona una cerveza</option>'+
                                        '<option value="0">HEINEKEN VIDRIO</option>'+
                                        '<option value="1">ULTRA LATA</option>'+
                                        '</select>';
                                    }else if(categoria == 123 && elemento.id == 2179){
                                        article += '<select class="form-control" style="margin-top: 2%;" id="notas'+elemento.id+'" required>'+
                                        '<option selected disabled value="0">Selecciona una cerveza</option>'+
                                        '<option value="0">XX LAGGER VIDRIO</option>'+
                                        '<option value="1">BOHEMIA CLARA</option>'+
                                        '</select>';
                                    }else if(categoria == 103){
										article += '<input type="hidden" name="data[notas'+elemento.id+']" type="text" placeholder="Notas Adicionales" style="width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;" value="2x1" id="notas'+elemento.id+'"/>';
									}else{
                                        article += '<input type="hidden" name="data[notas'+elemento.id+']" type="text" placeholder="Notas Adicionales" style="width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;" id="notas'+elemento.id+'"/>';
                                    }
                                    article += '<div class="row" style="margin-top: 5%;">'+
                        '<div style="width:100%">'+
                            '<div class="added d-none" id="label_added'+elemento.id+'">'+
                                ' <font size = "3">PRODUCTO AGREGADO A CARRITO</font>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div style="width:100%">'+
                        '<div style="margin-top: 3%;">'+
                                '<div class="pro-details-cart btn-hover" >'+
                                    '<input type="hidden" name="data[id'+elemento.id+']" value="'+elemento.id+'" id="id'+elemento.id+'"/>'+
                                    '<a href="javascript:addCarrito('+elemento.id+')" class="shop-btn animated" style="text-align:center;width:100%">Agregar <i class="fa fa-shopping-basket" aria-hidden="true"></i></a>'+
                                '</div>'+
                        '</div>'+  
                    '</div>'+
                '</article>'+
                '</div>';
        
        //console.log(article);
        });
        $('#articulo').html(article);
        $(".cantidad").inputSpinner({buttonsOnly: true, autoInterval: undefined}); 
    }
    //console.log(categoria);
    var pagina = 1;
    function ver_mas(){
        $.ajax({
            'url' : base_url + 'categorias/recargar_productos/'+ <?= $categoria['Categoria']['id'] ?>+"/"+variable+"/"+variable,
            'dataype' : 'json',
            'success' : function(obj){
                console.log(obj);
                articulos(obj.categoria.Productos,'#articulo');
            }
        });
    }
</script>