<?php
    $unidades = array(
        'Kg'=>'Kg',
        'Gr' => 'Gr',
        'Pieza'=>'Pieza',
        'Lt'=>'Lt',
        'Manojo' => 'Manojo',
		'Docena' => 'Docena'
    );
	
	$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if(isset($uri_segments[3])){
        $variable = $uri_segments[3];
    }else{
       $variable = $uri_segments[2];
    }
?>
<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
}
</style>
<?= $this->Html->script('admin/productos.js'); ?>
<div id="content" class="bg-container">
    <script>
        var id_producto =<?= $producto['Producto']['id']?>;
    </script>
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-10 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-cube"></i>
                        Productos
                    </h4>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="pagination">
                        <a onclick="prod_anterior(<?= $variable ?>)">❮</a>
                        <a onclick="prod_siguiente(<?= $variable ?>)">❯</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div>
        <div class="inner bg-container">
            <!-- editable data  table starts-->
            <div class="row">
                <div class="col">
                    <div style="height:80vh">
                        <div class="card-header bg-white">
                            <i class="fa fa-cube"> </i> <?= $producto['Producto']['nombre']?>
                        </div>
                        <?= $this->Form->create('Producto',array('type'=>'file','action' => 'view'))?>
                        <?= $this->Form->input('id',array('value'=>$producto['Producto']['id']))?>
                        <?= $this->Form->hidden('photo',array('value'=>$producto['Producto']['fotografia']))?>
                        <?= $this->Form->hidden('photo2',array('value'=>$producto['Producto']['fotografia_2']))?>
                        <?= $this->Form->hidden('photo3',array('value'=>$producto['Producto']['fotografia_3']))?>
                        <div class="card-body container">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $this->Form->input('unidad_principal',array('value'=>$producto['Producto']['unidad_principal'],'class'=>'form-control','type'=>'select','options'=>$unidades, 'label'=>'Unidad (Misma que en Dolibarr)'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('unidad_secundaria',array('value'=>$producto['Producto']['unidad_secundaria'],'empty'=>'No tiene Unidad Secundaria','class'=>'form-control','type'=>'select','options'=>$unidades))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('conversion',array('value'=>1/$producto['Producto']['conversion'],'class'=>'form-control','label'=>'Conversión de unidades'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('etiqueta',array('value'=>$producto['Producto']['etiqueta'],'class'=>'form-control','label'=>'Etiqueta','type'=>'text'))?>
                                </div>
                            </div>

                                <div class="col-md-12">
                                    <?= $this->Form->input('fotografia',array('class'=>'form-control','label'=>'Imagen (500 x 500)','type'=>'file'))?>
                                </div>
                                <div class="col-md-12">
                                    <?= $this->Form->input('fotografia_2',array('class'=>'form-control','label'=>'Imagen Secundaria (500 x 500)','type'=>'file'))?>
                                </div>
                                <div class="col-md-12">
                                    <?= $this->Form->input('fotografia_3',array('class'=>'form-control','label'=>'Imagen Secundaria (500 x 500)','type'=>'file'))?>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <label for="tags">selecciona tag: </label>
                                        <select name="tags" id="tags"></select> 
                                        <h4><span id="etiquetas"><i></i></span></h4>
                                        <br>
                                    </div>
                                <div class="row">
                                <div class="col-md-4">
                                    <p>Fotografía Principal</p>
                                    <?= $this->Html->image($producto['Producto']['fotografia'],array('style'=>'width:50%'))?>
                                </div>
                                <div class="col-md-3" style="margin-top:2%;">
                                    <label>Categorias</label>
                                    <select class="form-control" id="categorias">
                                        <option>Selecciona una opcion</option>
                                    </select>
                                    <div id="badges-categorias">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-top:2%;">
                                    <label>Subcategorias</label>
                                    <select class="form-control" id="subcategorias">
                                        <option>Selecciona una opcion</option>
                                    </select>
                                    <div id="badges-subcategorias">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:2%;">
                                    <label>Subcategorias 2</label>
                                    <select class="form-control" id="subcategorias2">
                                        
                                    </select>
                                    <div id="badges-subcategorias2">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <?= $this->Form->submit('Guardar Cambios',array('class'=>'btn btn-success btn-block'))?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<script>
var url = <?= $variable?>;
var base_url = "<?= Router::url('/', true); ?>";
$(document).ready(function(){
    traer_categorias();
    //traer_subcategorias2();
    productos_categorias();
    productos_subcategorias();
    productos_subcategorias2();
    $('#categorias').on('change',function(){
        $.ajax({
            'url' : base_url + 'categorias/agregar_producto',
            'type' : 'post', 
            'data' :{'producto_id':url,'categoria_id':$('#categorias').val()},
            'datatype' : 'json',
            'success' : function(obj){
                productos_categorias();
            }
        })
    })
    $('#subcategorias').on('change',function(){
        $.ajax({
            'url' : base_url + 'categorias/agregar_producto_sub',
            'type' : 'post', 
            'data' :{'producto_id':url,'subcategoria_id':$('#subcategorias').val(),'categoria_id':$('#categorias').val()},
            'datatype' : 'json',
            'success' : function(obj){
				//console.log(obj);
                productos_subcategorias();
            }
        })
    })
    $('#subcategorias2').on('change',function(){
        $.ajax({
            'url' : base_url + 'categorias/agregar_producto_sub2',
            'type' : 'post', 
            'data' :{'producto_id':url,'subcategoria2_id':$('#subcategorias2').val(),'categoria_id':$('#categorias').val(),'subcategoria_id':$('#subcategorias').val()},
            'datatype' : 'json',
            'success' : function(obj){
                productos_subcategorias2();
            }
        })
    })
})

function productos_categorias(){
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/categorias_productos',
        'type' : 'post', 
        'data' :{'id_producto':url},
        'datatype' : 'json',
        'success' : function(obj){
            $.each(obj,function(i,elemento){
                content += '<h5><span class="badge badge-success badge-pill">'+elemento.categorias.nombre+' <a onclick="eliminar_categoria('+elemento.categorias.id+','+url+')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></span></h5>';
                traer_subcategorias1_categorias(elemento.categorias.id);
            });
            $('#badges-categorias').html(content);
        }
    })
}

function prod_siguiente(id){
    //alert(id);
    var id_siguiente = id+1;
    window.location.href = base_url + 'productos/view/'+id_siguiente;
}

function prod_anterior(id){
    //alert(id);
    var id_anterior = id-1;
    window.location.href = base_url + 'productos/view/'+id_anterior;
}

function productos_subcategorias(){
    var content = "";
    $.ajax({
        'url' : base_url + 'categorias/subcategoria_productos',
        'type' : 'post', 
        'data' :{'id_producto':url},
        'datatype' : 'json',
        'success' : function(obj){
            //console.log(obj);
            $.each(obj,function(i,elemento){
                content += '<h5><span class="badge badge-primary badge-pill">'+elemento.subcategorias.nombre+' <a onclick="eliminar_subcategoria('+elemento.subcategorias.id+','+url+')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></span></h5>';
                traer_subcategorias2_categorias(elemento.subcategorias.id);
            });
            //console.log(content);
            $('#badges-subcategorias').html(content);
        }
    })
}

function productos_subcategorias2(){
    var content = "";
    $.ajax({
        'url' : base_url + 'categorias/subcategoria2_productos',
        'type' : 'post', 
        'data' :{'id_producto':url},
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj);
              //console.log(obj);
            $.each(obj,function(i,elemento){
                content += '<h5><span class="badge badge-info badge-pill">'+elemento.subcategorias2.nombre+' <a onclick="eliminar_subcategoria2('+elemento.subcategorias2.id+','+url+')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></span></h5>';
                traer_subcategorias2_categorias(elemento.subcategorias2.id);
            });
            //console.log(content);
            $('#badges-subcategorias2').html(content);
        }
    })
}

function traer_subcategorias2_categorias(subcategoria_id){
    //$('#tabla_subcategorias2').append('');
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias2_categorias',
        'type' : 'post',
        'data' : {'subcategoria_id':subcategoria_id},
        'datatype' : 'json',
        'success' : function(obj){
            content += '<option selected disabled style="color:red;"><b>'+obj.subcategoria[0].Subcategoria.nombre+'</b></option>';
            $.each(obj.subcategoriasDos,function(i,elemento){
                content += '<option value="'+elemento.SubcategoriaDos.id+'">'+elemento.SubcategoriaDos.nombre+'</option>';
            }); 
            $('#subcategorias2').prepend(content);
        }
    })
}

function traer_subcategorias1_categorias(categoria_id){
    $('#subcategorias').empty();
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias1_categorias',
        'type' : 'post',
        'data' : {'categoria_id':categoria_id},
        'datatype' : 'json',
        'success' : function(obj){
            content += '<option selected disabled style="color:red;"><b>'+obj.categoria[0].Categoria.nombre+'</b></option>';
            $.each(obj.subcategorias,function(i,elemento){
               content += '<option value="'+elemento.Subcategoria.id+'">'+elemento.Subcategoria.nombre+'</option>';
            }); 
            $('#subcategorias').prepend(content);
        }
    })
}

function traer_categorias(){
    //$('#tabla_categorias').append('');
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_categorias',
        'datatype' : 'json',
        'success' : function(obj){
            content += '<option selected disabled>Selecciona una opcion</option>'
            $.each(obj,function(i,elemento){
               content += '<option value="'+elemento.Categoria.id+'">'+elemento.Categoria.nombre+'</option>';
               
            }); 
            $('#categorias').prepend(content);
        }
    })
}

function eliminar_categoria(categoria_id,producto_id){
    var data = {'categoria_id' : categoria_id, 'producto_id':producto_id};
    $.ajax({
        'url' : base_url + 'categorias/eliminar_categoria_producto',
        'type' : 'post',
        'data' : data,
        'datatype':'json',
        'success':function(obj){
        }
    });
	traer_categorias();
    productos_categorias();
    productos_subcategorias();
}

function eliminar_subcategoria(subcategoria_id,producto_id){
    var data = {'subcategoria_id' : subcategoria_id, 'producto_id':producto_id};
    $.ajax({
        'url' : base_url + 'categorias/eliminar_subcategoria_producto',
        'type' : 'post',
        'data' : data,
        'datatype':'json',
        'success':function(obj){
        }
    });
    productos_subcategorias();
}

function eliminar_subcategoria2(subcategoria_id,producto_id){
    var data = {'subcategoria2_id' : subcategoria_id, 'producto_id':producto_id};
    $.ajax({
        'url' : base_url + 'categorias/eliminar_subcategoria2_producto',
        'type' : 'post',
        'data' : data,
        'datatype':'json',
        'success':function(obj){
        }
    });
    productos_subcategorias2();
}

  // $lev = levenshtein($input, $word);
</script>