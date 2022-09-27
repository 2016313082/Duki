<?php
    echo $this->Html->css(
        array(

            '/admin/vendors/select2/css/select2.min',
            '/admin/vendors/datatables/css/datatables_bootstrap4.min.css',
            //'/admin/css/pages/dataTables.bootstrap',
            //'/admin/css/pages/tables',
            //'/admin/vendors/datatables/css/colReorder.bootstrap.min',
            '/admin/vendors/daterangepicker/css/daterangepicker',
            '/admin/vendors/tooltipster/css/tooltipster.bundle.min',
            '/admin/vendors/tipso/css/tipso.min',
            '/admin/vendors/animate/css/animate.min'
        ),
        array('inline'=>false)
    );

    echo $this->Html->script(
        array(
            '/admin/vendors/select2/js/select2',
            '/admin/vendors/datatables/js/datatables.min',
            //'/admin/vendors/datatables/js/dataTables.bootstrap.min',
            //'/admin/js/pages/advanced_tables',
            '/admin/pluginjs/dataTables.tableTools',
            '/admin/vendors/datatables/js/dataTables.colReorder.min',
            '/admin/vendors/datatables/js/dataTables.buttons.min',
            '/admin/vendors/datatables/js/dataTables.responsive.min',
            '/admin/vendors/datatables/js/dataTables.rowReorder.min',
            '/admin/vendors/datatables/js/buttons.colVis.min',
            '/admin/vendors/datatables/js/buttons.html5.min',
            '/admin/vendors/datatables/js/buttons.bootstrap.min',
            '/admin/vendors/datatables/js/buttons.print.min',
            '/admin/vendors/datatables/js/dataTables.scroller.min',
            '/admin/vendors/moment/js/moment.min',
            '/admin/vendors/daterangepicker/js/daterangepicker',
            '/admin/vendors/tooltipster/js/tooltipster.bundle.min',
            '/admin/vendors/tipso/js/tipso.min'
        ),
        array('inline'=>false)
    );

    $descuentos = array(1=>'Monto',2=>'Descuento');
?>
<?php

?>
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-cubes"></i>
                        Categorias
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <!-- editable data  table starts-->
            <div class="row">
                <div class="col">
                    <div class="card-header bg-white">
                        <i class="fa fa-table"> </i> Lista de categorias
                        <div style="float:right">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="container-fluid" style="margin-top: 2%;">
                                <button class="btn btn-success form-control" data-toggle="modal" data-target="#agregar_categoria">Agregar categoria</button><br><br>
                                <table id="tabla_categorias" class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <h2>Raíz categorias</h2>
                            <div id="raiz-categorias">
                                <div class="form-row">
                                    <div class="col-12">
                                        <span>Categorias</span>
                                        <div id="orden-categorias"></div>
                                    </div>
                                    <div class="col-12">
                                        <span>Subcategorias</span>
                                        <div id="orden-subcategorias"></div>
                                    </div>
                                    <div class="col-12">
                                        <span>Subcategorias 2</span>
                                        <div id="orden-subcategoriasDos"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <div class="container-fluid" style="margin-top: 5%;">
                                <button class="btn btn-success form-control" data-toggle="modal" data-target="#agregar_subcategoria">Agregar Subcategoria</button><br><br>
                                <table id="tabla_subcategorias1" class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="container-fluid" style="margin-top: 5%;">
                                <button class="btn btn-success form-control" data-toggle="modal" data-target="#agregar_subcategoria_dos">Agregar Subcategoria 2</button><br><br>
                                <table id="tabla_subcategorias2" class="table table-sm table-bordered table-hover">
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>   
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- Modal Agregar categoria -->
<div class="modal fade" id="agregar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="col-12">
                    <input class="form-control" placeholder="Nombre de la categoria" id="nombre_categoria">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="agregar_categoria()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar categoria -->
<div class="modal fade" id="editar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="col-4">
                    <input class="form-control" placeholder="Nombre de la categoria" id="id_categoria" readonly>
                </div>
                <div class="col-8">
                    <input class="form-control" placeholder="Nombre de la categoria" id="nombre_categoria_editar">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editar_categoria()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar subcategoria-->
<div class="modal fade" id="agregar_subcategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Subcategoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="col-12">
                    <label for="nombre_subcategoria">Nombre de la subcategoria</label>
                    <input class="form-control" placeholder="Nombre de la subcategoria" id="nombre_subcategoria">
                </div>
                <div class="col-8">
                    <label for="id_categoria_select">Categoria</label>
                    <select class="form-control" id="id_categoria_select">
                        
                    </select>
                </div>
                <div class="col-4">
                    <div class="custom-control custom-switch" style="margin-top: 28%; width:30px; height:30px;">
                        <input type="checkbox" class="custom-control-input" id="status_activo">
                        <label class="custom-control-label" for="status_activo"><h5 id="status_texto">Inactivo</h5></label> 
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregar_subcategoria()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar subcategoria-->
<div class="modal fade" id="editar_subcategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Subcategoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="col-4">
                    <label for="nombre_subcategoria_editar">ID</label>
                    <input class="form-control" placeholder="Id" id="id_subcategoria" readonly>
                </div>
                <div class="col-8">
                    <label for="nombre_subcategoria_editar">Nombre de la subcategoria</label>
                    <input class="form-control" placeholder="Nombre de la subcategoria" id="nombre_subcategoria_editar">
                </div>
                <div class="col-8">
                    <label for="id_categoria_editar">Categoria</label>
                    <select class="form-control" id="id_categoria_editar">
                        
                    </select>
                </div>
                <div class="col-4">
                    <div class="custom-control custom-switch" style="margin-top: 28%; width:30px; height:30px;">
                        <input type="checkbox" class="custom-control-input" id="status_activo_editar">
                        <label class="custom-control-label" for="status_activo_editar"><h5 id="status_texto_editar">Inactivo</h5></label> 
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="edit_subcategoria()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar Subcategoria dos -->
<div class="modal fade" id="agregar_subcategoria_dos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Subcategoria 2 <i class="bi bi-geo-alt"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="col-12">
                <label for="nombre_subcategoria_editar">Nombre de la subcategoria Dos</label>
                <input class="form-control" placeholder="Nombre de la subcategoria" id="nombre_subcategoria_2">
            </div>
            <div class="col-8">
                <label for="id_categoria_editar">Subcategoria</label>
                <select class="form-control" id="id_categoria_sub">
                    
                </select>
            </div>
            <div class="col-4">
                <div class="custom-control custom-switch" style="margin-top: 28%; width:30px; height:30px;">
                    <input type="checkbox" class="custom-control-input" id="status_activo_2">
                    <label class="custom-control-label" for="status_activo_2"><h5 id="status_texto_2">Inactivo</h5></label> 
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregar_subcategoriaDos()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Subcategoria dos -->
<div class="modal fade" id="editar_subcategoria_dos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Subcategoria 2</i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="col-4">
                <label for="id_subcategoria_editar">ID</label>
                <input class="form-control" placeholder="ID" id="id_subcategoria_editar">
            </div>
            <div class="col-8">
                <label for="nombre_subcategoria_editar">Nombre de la subcategoria Dos</label>
                <input class="form-control" placeholder="Nombre de la subcategoria" id="editar_nombre_2">
            </div>
            <div class="col-8">
                <label for="id_categoria_editar">Subcategoria</label>
                <select class="form-control" id="id_categoria_sub2">
                    
                </select>
            </div>
            <div class="col-4">
                <div class="custom-control custom-switch" style="margin-top: 28%; width:30px; height:30px;">
                    <input type="checkbox" class="custom-control-input" id="editar_status_activo">
                    <label class="custom-control-label" for="editar_status_activo"><h5 id="editar_status_texto">Inactivo</h5></label> 
                </div>
            </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="editar_subcategoriaDos()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>


<script>
var tabla;
var tablaSub;
var tablaSub2;
var columnas = [];
var columnas1 = [];
var columnas2 = [];
var base_url = "<?= Router::url('/', true); ?>";
'use strict';
$(document).ready(function () {
    $('#status_activo').click(function () {
		if ($('#status_activo').is(':checked')) {
			$('#status_texto').text('Activo');
		} else {
            $('#status_texto').text('Inactivo');
		}
	});

    $('#status_activo_editar').click(function () {
		if ($('#status_activo_editar').is(':checked')) {
			$('#status_texto_editar').text('Activo');
		} else {
            $('#status_texto_editar').text('Inactivo');
		}
	});
	
	$('#status_activo_2').click(function(){
		if ($('#status_activo_2').is(':checked')) {
			$('#status_texto_2').text('Activo');
		} else {
            $('#status_texto_2').text('Inactivo');
		}
	});
	
	$('#editar_status_activo').click(function(){
		if ($('#editar_status_activo').is(':checked')){
			$('#editar_status_texto').text('Activo');
		} else {
            $('#editar_status_texto').text('Inactivo');
		}
	});

    tabla = $('#tabla_categorias').DataTable({
		responsive: true,
		order: [[1, "asc"]],
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		},
        "scrollY":"200px",
        "scrollCollapse": true
	});

    tablaSub = $('#tabla_subcategorias1').DataTable({
		responsive: true,
		order: [[1, "asc"]],
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		},
        "scrollY":"200px",
        "scrollCollapse": true
	});

    tablaSub2 = $('#tabla_subcategorias2').DataTable({
		responsive: true,
		order: [[1, "asc"]],
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		},
        "scrollY":"200px",
        "scrollCollapse": true
	});

    $('#tabla_categorias thead tr th').each(function() {
		columnas.push($(this).html());
	});

    $('#tabla_subcategorias1 thead tr th').each(function() {
		columnas.push($(this).html());
	});

    $('#tabla_subcategorias2 thead tr th').each(function() {
		columnas.push($(this).html());
	});
    
    traer_categorias();
    traer_subcategorias1();
    traer_subcategorias2();
});

function agregar_subcategoria(){
    if ($('#status_activo').is(':checked')) {
		var status = 1;
	}else {
        var status = 0;
	}
    var nombre = $('#nombre_subcategoria').val();
    var id_categoria = $('#id_categoria_select').val();
    var campos = {'nombre':nombre,'status':status,'id_categoria':id_categoria};
    $.ajax({
        'url' : base_url + 'categorias/agregar_subcategoria',
        'type' : 'post',
        'data' : campos,
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == true){
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Se ha registrado la subcategoria'
                })
                $('#agregar_subcategoria').modal('hide');
                $('#tabla_subcategorias1 tbody').empty();
                traer_subcategorias1();
            }
        }
    });
}

function traer_categorias(){
    $('#tabla_categorias').append('');
    var content = '';
	var contentBadges = '';
    var status = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_categorias',
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj);
            content += '<option disabled selected>Selecciona una categoria</option>';
            tabla.clear().draw();
            $.each(obj,function(i,elemento){
				contentBadges += '<a href="#" onclick="subcategorias('+elemento.Categoria.id+')"><span class="badge badge-pill badge-success" style="font-size: 100%;">'+elemento.Categoria.nombre+'</span></a>';
                if(elemento.Categoria.status == 0){
                    status = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                }else{
                    status = '<span class="badge badge-pill badge-success">Activo</span>';
                }
                //console.log(obj);
                content += '<option value="'+elemento.Categoria.id+'">'+elemento.Categoria.nombre+'</option>';
                var nuevaFila = tabla.row.add([
                    elemento.Categoria.id,
                    elemento.Categoria.nombre,
                    status,
                    '<button class="btn btn-info" onclick="traer_categoria('+elemento.Categoria.id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>' +
                    '<button class="btn btn-danger" onclick="eliminar_categoria('+elemento.Categoria.id+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                ]).draw().node();

                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas[index]);
                });
            });
            
            $('#id_categoria_select').prepend(content);
            $('#id_categoria_editar').prepend(content);
            $('#orden-categorias').html(contentBadges);
        }
    })
}


function traer_subcategorias1(){
    $('#tabla_subcategorias1').append('');
	$('#id_categoria_sub').html('');
            $('#id_categoria_sub2').html('');
    var content = '';
    var status = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias1',
        'datatype' : 'json',
        'success' : function(obj){
            content += '<option disabled selected>Selecciona una Subcategoria</option>';
            tablaSub.clear().draw();
            $.each(obj,function(i,elemento){
                if(elemento.Subcategoria.status == 0){
                    status = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                }else{
                    status = '<span class="badge badge-pill badge-success">Activo</span>';
                }
                content += '<option value="'+elemento.Subcategoria.id+'">'+elemento.Subcategoria.nombre+'</option>';
                var nuevaFila = tablaSub.row.add([
                    elemento.Subcategoria.id,
                    elemento.Subcategoria.nombre,
                    status,
                    '<button class="btn btn-info" onclick="editar_subcategoria('+elemento.Subcategoria.id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
                    '<button class="btn btn-danger" onclick="eliminar_subcategoria('+elemento.Subcategoria.id+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                ]).draw().node();
                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas1[index]);
                })
            });
            $('#id_categoria_sub').prepend(content);
            $('#id_categoria_sub2').prepend(content);
        }
    })
}

function traer_subcategorias2(){
    $('#tabla_subcategorias2').append('');
    var content = '';
    var status = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias2',
        'datatype' : 'json',
        'success' : function(obj){
            tablaSub2.clear().draw();
            $.each(obj,function(i,elemento){
                if(elemento.SubcategoriaDos.status == 0){
                    status = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                }else{
                    status = '<span class="badge badge-pill badge-success">Activo</span>';
                }
               var nuevaFila = tablaSub2.row.add([
                    elemento.SubcategoriaDos.id,
                    elemento.SubcategoriaDos.nombre,
                    status,
                    '<button class="btn btn-info" onclick="editar_subcategoria_2('+elemento.SubcategoriaDos.id+')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
                    '<button class="btn btn-danger" onclick="eliminar_subcategoria_2('+elemento.SubcategoriaDos.id+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
               ]).draw().node();

                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas2[index]);
                })
            });
        }
    })
}

function agregar_categoria(){
    var nombre = $('#nombre_categoria').val();
    $.ajax({
        'url' : base_url + 'categorias/agregar_categoria',
        'type' : 'post',
        'data' : {'nombre' : nombre},
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == true){
                $('#agregar_categoria').modal('hide');
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Se ha agregado la categoría',
                });
                traer_categorias();
            }
        }
    })
}

function eliminar_categoria(id){
    swal.fire({
        'icon' : 'warning',
        'title' : 'Seguro que quieres eliminar esta categoría?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                'url': base_url + 'categorias/eliminar_categoria',
                'type' : 'post',
                'data' : {'id' : id},
                'datatype' : 'json',
                'success' : function(obj){
                    swal.fire({
                        'icon' : 'success',
                        'title' : 'Se ha eliminado correctamente',
                    });
                    $('#tabla_categorias tbody').empty();
                    traer_categorias();
                }
            })    
        }
    })
}

function traer_categoria(id){
    //var nombre = $('#nombre_categoria_editar').val();
    $.ajax({
        'url': base_url + 'categorias/traer_categoria',
        'type' : 'post',
        'data' : {'id':id},
        'datatype' : 'json',
        'success' : function(obj){
            $('#nombre_categoria_editar').val(obj.Categoria.nombre);
            $('#id_categoria').val(obj.Categoria.id);
        }
    });
    $('#editar_categoria').modal('show');
}

function editar_categoria(){
    var nombre = $('#nombre_categoria_editar').val();
    var id = $('#id_categoria').val();
    $.ajax({
        'url' : base_url + 'categorias/editar_categoria',
        'type' : 'post',
        'data' : {
            'id' : id,
            'nombre':nombre
        },
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == true){
                swal.fire({
                    'icon':'success',
                    'title' : 'Se ha actualizado la categoría',
                });
                $('#editar_categoria').modal('hide');
                $('#tabla_categorias tbody').empty();
                traer_categorias();
            }else{
                swal.fire({
                    'icon':'error',
                    'title' : 'No se pudo actualizar la categoría',
                })
            }
        }
    });
}

function eliminar_subcategoria(id){
    swal.fire({
        'icon' : 'warning',
        'title' : 'Seguro que quieres eliminar esta subcategoría?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                'url': base_url + 'categorias/eliminar_subcategoria',
                'type' : 'post',
                'data' : {'id' : id},
                'datatype' : 'json',
                'success' : function(obj){
                    swal.fire({
                        'icon' : 'success',
                        'title' : 'Se ha eliminado correctamente',
                    });
                    $('#tabla_subcategorias1 tbody').empty();
                    traer_subcategorias1();
                }
            })    
        }
    })
}

function editar_subcategoria(id){
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategoria',
        'type' : 'post',
        'data' : {'id' : id},
        'datatype' : 'json',
        'success' : function(obj){
            $('#id_subcategoria').val(obj.Subcategoria.id);
            $('#nombre_subcategoria_editar').val(obj.Subcategoria.nombre);
            $('#id_categoria_editar [value='+obj.Subcategoria.id_categoria+']').attr('selected',true);
            if(obj.Subcategoria.status == 1){
                $( "#status_activo_editar" ).prop( "checked", true );
                $('#status_texto_editar').text('Activo');
            }else{
                $( "#status_activo_editar" ).prop( "checked", false );
                $('#status_texto_editar').text('Inactivo');
            }
        }
    });
    $('#editar_subcategoria').modal('show');
}

function edit_subcategoria(){
    if ($('#status_activo_editar').is(':checked')) {
		var status = 1;
	}else {
        var status = 0;
	}
    var id_subcategoria = $('#id_subcategoria').val();
    var nombre = $('#nombre_subcategoria_editar').val();
    var id_categoria = $('#id_categoria_editar').val();
    var campos = {'id':id_subcategoria,'nombre':nombre,'status':status,'id_categoria':id_categoria};
    $.ajax({
        'url' : base_url + 'categorias/editar_subcategoria',
        'type' : 'post',
        'data' : campos,
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == true){
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Se ha actualizado la subcategoria',
                })
                $('#editar_subcategoria').modal('hide');
                $('#tabla_subcategorias1 tbody').empty();
                traer_subcategorias1();
            }else{
                swal.fire({
                    'icon' : 'error',
                    'title' : 'No se pudo actualizar la subcategoria',
                })
            }
        }
     })
}

function editar_subcategoriaDos(){
    if ($('#editar_status_activo').is(':checked')){
		var status = 1;
	}else{
        var status = 0;
	}
    var id = $('#id_subcategoria_editar').val();
    var nombre = $('#editar_nombre_2').val();
    var id_subcategoria = $('#id_categoria_sub2').val();
    var campos = {'id':id,'nombre':nombre,'status':status,'id_subcategoria':id_subcategoria};
    $.ajax({
        'url' : base_url + 'categorias/editar_subcategoria_2',
        'type' : 'post',
        'data' : campos,
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == true){
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Se ha actualizado la subcategoria 2',
                })
                $('#editar_subcategoria').modal('hide');
                $('#tabla_subcategorias1 tbody').empty();
                traer_subcategorias2();
            }else{
                swal.fire({
                    'icon' : 'error',
                    'title' : 'No se pudo actualizar la subcategoria',
                })
            }
        }
     })
}

function agregar_subcategoriaDos(){
    if ($('#status_activo_2').is(':checked')) {
		var status = 1;
	}else {
        var status = 0;
	}
    var nombre = $('#nombre_subcategoria_2').val();
    var id_categoria = $('#id_categoria_sub').val();
    var campos = {'nombre':nombre,'status':status,'id_subcategoria':id_categoria}
    $.ajax({
        'url' : base_url + 'categorias/agregar_subcategoriaDos',
        'type' : 'post',
        'data' : campos,
        'dataype' : 'json',
        'success' : function(obj){
            if(obj == true){
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Se ha agregado la subcategoria 2',
                })
                $('#agregar_subcategoria_dos').modal('hide');
                $('#tabla_subcategorias2 tbody').empty();
                traer_subcategorias2();
            }else{
                swal.fire({
                    'icon' : 'error',
                    'title' : 'No se pudo actualizar la subcategoria 2',
                })
            }
        }
    })
}

function eliminar_subcategoria_2(id){
    swal.fire({
        'icon' : 'warning',
        'title' : 'Seguro que quieres eliminar esta subcategoría?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                'url': base_url + 'categorias/eliminar_subcategoriaDos',
                'type' : 'post',
                'data' : {'id' : id},
                'datatype' : 'json',
                'success' : function(obj){
                    swal.fire({
                        'icon' : 'success',
                        'title' : 'Se ha eliminado correctamente',
                    });
                    $('#tabla_subcategorias2 tbody').empty();
                    traer_subcategorias2();
                }
            })    
        }
    })
}

function editar_subcategoria_2(id){
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategoriaDos',
        'type' : 'post',
        'data' : {'id' : id},
        'datatype' : 'json',
        'success' : function(obj){
			$('#id_subcategoria_editar').val(obj.SubcategoriaDos.id);
            $('#editar_nombre_2').val(obj.SubcategoriaDos.nombre);
            $('#id_categoria_sub2 [value='+obj.SubcategoriaDos.id_subcategoria+']').attr('selected',true);
            if(obj.SubcategoriaDos.status == 1){
                $( "#editar_status_activo" ).prop( "checked", true );
                $('#editar_status_texto').text('Activo');
            }else{
                $( "#editar_status_activo" ).prop( "checked", false );
                $('#editar_status_texto').text('Inactivo');
            } 
        }
    });
    $('#editar_subcategoria_dos').modal('show');
}

function subcategorias(id){
    $('#orden-subcategorias').html('');
    $('#orden-subcategoriasDos').html('');
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias1_categorias',
        'type' : 'post',
        'data' : {'categoria_id' : id},
        'datatype' : 'json',
        'success' : function(obj){
            $.each(obj.subcategorias,function(i,elemento){
                console.log(elemento.Subcategoria);
                content += '<a href="#" onclick="subcategoriasDos('+elemento.Subcategoria.id+')"><span class="badge badge-pill badge-info" style="font-size: 100%;">'+elemento.Subcategoria.nombre+'</span></a>';
            });
            $('#orden-subcategorias').html(content);
        }
    })
}

function subcategoriasDos(id){
    $('#orden-subcategoriasDos').html('');
    var content = '';
    $.ajax({
        'url' : base_url + 'categorias/traer_subcategorias2_categorias',
        'type' : 'post',
        'data' : {'subcategoria_id' : id},
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj);
            $.each(obj.subcategoriasDos,function(i,elemento){
                console.log(elemento);
                content += '<a href="#" onclick="subcategoriasDos('+elemento.SubcategoriaDos.id+')"><span class="badge badge-pill badge-primary" style="font-size: 100%;">'+elemento.SubcategoriaDos.nombre+'</span></a>';
            });
            $('#orden-subcategoriasDos').html(content);
        }
    })
}
</script>
