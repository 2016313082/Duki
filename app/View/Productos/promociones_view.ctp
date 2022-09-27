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
?>
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                        Promociones DUKI
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="form-row">
                <div class="col-12">
                    <h3>Productos de mercadito</h3>
                    
                    <button class="btn btn-block btn-success" style="margin-top:2%;" data-toggle="modal" data-target="#modal-mercadito">Agregar producto a mercadito</button>
                    <table class="table" style="margin: top 2%;" id="tabla-mercadito">
                        <thead>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Etiqueta</th>
                            <th>Acciones</th>
                        </thead>
                        <body>
                           
                        </body>
                    </table>
                </div>
                <!-- <div class="col-6">
                    <h3>Productos de promociones</h3>
                    <button class="btn btn-block btn-success" style="margin-top:2%;" data-toggle="modal" data-target="#modal-promociones">Agregar producto a promociones</button>
                    <table class="table" style="margin-top:2%;">
                        <thead>
                            <th>Nombre</th>
                            <th>Etiqueta</th>
                            <th>Acciones</th>
                        </thead>
                        <body>
                            <tr>
                                <td>Carne molida</td>
                                <td>Antes $250</td>
                                <td><button class="btn btn-danger"></button></td>
                            </tr>
                        </body>
                    </table>
                </div> -->
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal-mercadito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar productos a mercadito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class='table' id="tabla-productos">
            <thead>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <body>
                
            </body>
          </table>
        <!-- <input class="form-control" placeholder="Busca el producto" id="buscar-producto">
        <select class="form-control" style="margin-top: 2%;" id="productos">
            <option>Selecciona un producto</option>
        </select> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal promociones -->
<div class="modal fade bd-example-modal-lg" id="modal-promociones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar productos a promociones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
var tabla = '';
var columnas = [];
$(document).ready(function(){
    tabla = $('#tabla-mercadito').DataTable({
        /* processing: true,
        serverSide: true, */
		responsive: true,
		order: [[1, "asc"]],
		"language": {
            processing: true,
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            serverSide: true,
            
		},
        "scrollY":"400px",
        "scrollCollapse": true
	});

    tabla_productos = $('#tabla-productos').DataTable({
        /* processing: true,
        serverSide: true, */
		responsive: true,
		order: [[1, "asc"]],
		"language": {
            processing: true,
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            serverSide: true,
            
		},
        "scrollY":"400px",
        "scrollCollapse": true
	});
    $('#tabla-productos thead tr th').each(function() {
		columnas.push($(this).html());
	});
    traer_productos();
    traer_mercadito();
    var content = "";
});

function traer_productos(){
    $.ajax({
        'url' : base_url + 'productos/buscar_producto',
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj);
            tabla_productos.clear().draw();
            $.each(obj,function(i,elemento){
                var nuevaFila = tabla_productos.row.add([
                    elemento.Producto.sku,
                    elemento.Producto.nombre,
                    '<td><button class="btn btn-success" onclick="agregar_mercadito('+elemento.Producto.id+')"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button></td>'
                ]).draw().node();
                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas[index]);
                })
            })
        }
    })
}

function traer_mercadito(){
    $.ajax({
        'url' : base_url + 'productos/traer_mercadito',
        'datatype' : 'json',
        'success' : function(obj){
            tabla.clear().draw();
            $.each(obj,function(i,elemento){
                var nuevaFila = tabla.row.add([
                    elemento.Producto.sku,
                    elemento.Producto.nombre,
                    elemento.Producto.etiqueta,
                    '<td><button class="btn btn-danger" onclick="borrar_mercadito('+elemento.Producto.id+')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'
                ]).draw().node();

                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas[index]);
                })
            })
        }
    })
}

function agregar_mercadito(id){
    $.ajax({
            'url' : base_url + 'productos/agregar_producto',
            'type' : 'post',
            'data' : {'producto_id':id,'categoria_id':104},
            'datatype' : 'json',
            'success' : function(obj){
                console.log(obj);
                if(obj == true){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Se ha agregado a mercadito',
                    })
                traer_mercadito();
            }else{
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo agregar mercadito, el producto ya esta agregado',
                    })
            }
            }
        })
}

function borrar_mercadito(id){
    $.ajax({
        'url':base_url + 'productos/eliminar_mercadito',
        'type' : 'post',
        'data' : {'id':id},
        'dataype' : 'json',
        'success' : function(obj){
            console.log(obj);
            if(obj == true){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Se ha eliminado de mercadito',
                    })
                traer_mercadito();
            }else{
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo eliminar de mercadito',
                    })
            }
        }
    })
}
</script>