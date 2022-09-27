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
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-cubes"></i>
                        Productos
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
                    <div class="card" style="height:80vh">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"> </i> Lista de Productos
                            <div style="float:right">
                                <?= $this->Html->link('Sincronizar Datos con Dolibarr',array('controller'=>'productos','action'=>'sincronizar'),array('class'=>'btn button-alignment btn-success'))?>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y:scroll">
                            <div class="m-t-35">
                                <table id="producto_lista" class="table table-sm table-bordered table-hover">
                                    <thead>
                                        <th>SKU</th>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Venta</th>
                                        <th>Unidad Principal</th>
                                        <th>Unidad Secundaria</th>
                                        <th>Factor de Conversión</th>
                                        <th>Etiqueta</th>
                                        <th>Actualizar</th>
                                    </thead>
                                    <tbody></tbody>
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

<div class="modal fade" id="nuevo_cupon" role="dialog" aria-labelledby="modalLabelsuccess">
    <div class="modal-dialog" role="document">
        <?= $this->Form->create('Cupon',array('url'=>array('controller'=>'cupons','action'=>'add')))?>
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="modalLabelsuccess">Crear Nuevo Cupón</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->Form->input('cupon',array('class'=>'form-control','label'=>'Cupón','type'=>'text'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('monto',array('class'=>'form-control','label'=>'Monto','type'=>'number'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('tipo_descuento',array('empty'=>'Seleccionar','class'=>'form-control','label'=>'Tipo de Descuento','type'=>'select','options'=>$descuentos))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('rango_fechas', array('label'=>'Vigencia de Cupón','class'=>'form-control', 'placeholder'=>'dd/mm/yyyy - dd/mm/yyyy', 'id'=>'date_range', 'required'=>true, 'autocomplete'=>'off')); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('monto_minimo_compra',array('class'=>'form-control','label'=>'Monto Mínimo de compra','type'=>'number'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('unique',array('empty'=>'Seleccionar','class'=>'form-control','label'=>'Uso único','type'=>'select','options'=>[0=>'No',1=>'Si']))?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->Form->submit('Crear Cupón',array('class'=>'btn  btn-success'))?>
            </div>
        </div>
        <?= $this->Form->end()?>
    </div>
</div>

<script>
var table = "";
var columnas = [];

$(document).ready(function () {

    
    $('#form-productos').on('submit',function(e){
       
    });

    tabla = $('#producto_lista').DataTable({
        /* processing: true,
        serverSide: true, */
		responsive: true,
		order: [[1, "asc"]],
		"language": {
            processing: true,
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
            serverSide: true,
		},
        "scrollY":"300px",
        "scrollCollapse": true
	});

    $('#producto_lista thead tr th').each(function() {
		columnas.push($(this).html());
	});
    cargar_datos();
});

function cargar_datos(){
    var unidad_secundaria ='';

    $.ajax({  
        'url':base_url+ 'Productos/ver_datos',
        'datatype':'json',
        'success':function(obj){
            $.each(obj,function(i,elemento){
                if(elemento.Producto.unidad_secundaria == ''){
                        unidad_secundaria='<option>selecciona una opcion</option>';
                    }else{
                    unidad_secundaria = '<option value="'+elemento.Producto.unidad_secundaria+'" >'+elemento.Producto.unidad_secundaria+'</option>'
                    }
                    console.log(elemento.Producto.fotografia);

                var nuevaFila = tabla.row.add([
                    elemento.Producto.sku,
                    '<img style="height:50px" src="'+base_url+elemento.Producto.fotografia+'">',
                    elemento.Producto.nombre,
                    elemento.Producto.inventario,
                    elemento.Producto.precio_venta,
                    '<select id="unidad_principal'+elemento.Producto.id+'" value="'+elemento.Producto.unidad_principal+'">'+
                    '<option selected>'+elemento.Producto.unidad_principal+'</option>'+ 
                    '<option value="kg" >Kg</option>'+
                    '<option value="Gr" >Gr</option>'+
                    '<option value="Pieza">Pieza</option>'+
                    '<option value="Lt" >Lt</option>'+
                    '<option value="Manojo" >Manojo</option>'+
                    '<option value="Docena" >Docena</option>'+
                    '</select>',

                    '<select id="unidad_secundaria'+elemento.Producto.id+'" value="'+elemento.Producto.unidad_secundaria+'">'+
                    unidad_secundaria+
                    '<option value="kg" >Kg</option>'+
                    '<option value="Gr" >Gr</option>'+
                    '<option value="Pieza">Pieza</option>'+
                    '<option value="Lt" >Lt</option>'+
                    '<option value="Manojo" >Manojo</option>'+
                    '<option value="Docena" >Docena</option>'+
                    '</select>',

                    '<input id="conversion'+elemento.Producto.id+'" value="'+elemento.Producto.conversion+'">',
                    '<input id="etiqueta'+elemento.Producto.id+'" value="'+elemento.Producto.etiqueta+'">',
                    '<a class="btn btn-outline-success" href=""><i class="fa fa-check-square-o" aria-hidden="true" onclick="convertir_input('+elemento.Producto.id+');"></i></a>'+
                    '<a class="btn btn-outline-info" href="'+base_url+'/Productos/view/'+elemento.Producto.id+'"><i class="fa fa-cogs" ></i></a>'


                ]).draw().node();

                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas[index]);
                });
            });
        }
    })
}

function convertir_input(id){
    var data = {
        'id':id,
        'unidad_principal': $('#unidad_principal'+id).val(),
        'unidad_secundaria':$('#unidad_secundaria'+id).val(),
        'conversion' : $('#conversion'+id).val(),
        'etiqueta' : $('#etiqueta'+id).val()
    };
    Swal.fire({
            title: '¿Estas seguro?',
            text: "No podras revertir la actualizacion!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, cancelar!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, actualizar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    'url':base_url+'Productos/edit',
                    'type' : 'post',
                    'data' : data,
                    'datatype':'json',
                    'success':function(obj){
                        console.log(obj); //servidor
                        if(obj==true){
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
                            title: 'Se ha actualizado correctamente'
                        })
                        }
                        

                    }
                })
            }
        })
    //console.log(data); //cliente
                        
         

   /*  swal.fire({
        'icon':'warning',
        'title':'seguro que deseas modificar esta linea?',
    }) */
    //alert($('#sku'+id).val());
}
</script>
