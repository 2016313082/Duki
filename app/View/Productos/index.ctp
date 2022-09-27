<?php
    echo $this->Html->css(
        array(
            '/admin/vendors/select2/css/select2.min',
            '/admin/vendors/datatables/css/dataTables.bootstrap.min',
            '/admin/css/pages/dataTables.bootstrap',
            '/admin/css/pages/tables',
            '/admin/vendors/datatables/css/colReorder.bootstrap.min',
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
            '/admin/vendors/datatables/js/jquery.dataTables.min',
            '/admin/vendors/datatables/js/dataTables.bootstrap.min',
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
                                <table id="example" class="table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Venta</th>
                                            <th>Unidad Principal</th>
                                            <th>Unidad Secundaria</th>
                                            <th>Factor de Conversión</th>
                                            <th>Etiqueta</th>
                                            <th>Configurar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($productos as $producto):?>
                                            <?php 
                                                if($producto['Producto']['conversion'] == '' || $producto['Producto']['unidad_principal'] == '' || $producto['Producto']['unidad_secundaria'] == '' || $producto['Producto']['fotografia'] == '' || $producto['Producto']['inventario'] < 1){
                                                    $conversion = "background-color: #90D4FF;";
                                                }else if($producto['Producto']['etiqueta'] != ''){
                                                    $conversion = "background-color: #88F018;";
                                                }else{
                                                    $conversion = '';
                                                }	
                                            ?>
                                            <tr style="<?= $conversion ?>">
                                                <td><?= $producto['Producto']['sku'] ?></td>
                                                <td><?= $producto['Producto']['nombre'] ?></td>
                                                <td><?= $producto['Producto']['inventario'] ?></td>
                                                <td><?= $producto['Producto']['precio_venta'] ?></td>
                                                <td><select id="unidad_principal<?= $producto['Producto']['id'] ?>">
                                                    <option value="<?= $producto['Producto']['unidad_principal']?>" selected><?= $producto['Producto']['unidad_principal']?></option>
                                                    <option value="kg" >Kg</option>
                                                    <option value="Gr" >Gr</option>
                                                    <option value="Pieza">Pieza</option>
                                                    <option value="Lt" >Lt</option>
                                                    <option value="Manojo" >Manojo</option>
                                                    <option value="Docena" >Docena</option>
                                                    <option value="">Sin unidad</option>
                                                </select></td>
                                                <?php 
                                                    if($producto['Producto']['unidad_secundaria'] == ""){
                                                        $opcion = 'Selecciona una opcion';
                                                        $valor = "";
                                                    }else{
                                                        $opcion = $producto['Producto']['unidad_secundaria'];
                                                        $valor = $producto['Producto']['unidad_secundaria'];
                                                    }
                                                ?>
                                                <td><select id="unidad_secundaria<?= $producto['Producto']['id'] ?>">
                                                    <option selected readonly value="<?= $valor ?>" selected><?= $opcion ?></option>
                                                    <option value="kg" >Kg</option>
                                                    <option value="Gr" >Gr</option>
                                                    <option value="Pieza">Pieza</option>
                                                    <option value="Lt" >Lt</option>
                                                    <option value="Manojo" >Manojo</option>
                                                    <option value="Docena" >Docena</option>
                                                    <option value="">Sin unidad</option>
                                                </select></td>
                                                <td><input id="conversion<?= $producto['Producto']['id'] ?>" value="<?= $producto['Producto']['conversion'] ?>"></td>
                                                <td><input id="etiqueta<?= $producto['Producto']['id'] ?>" value="<?= $producto['Producto']['etiqueta'] ?>"></td>
                                                <td>
                                                    <button onclick="convertir_input(<?= $producto['Producto']['id'] ?>);" class="btn btn-outline-success" ><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                                                    <a class="btn btn-outline-info" href="<?= Router::url('/', true); ?>/Productos/view/<?= $producto['Producto']['id'] ?>"><i class="fa fa-cogs" ></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
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

<script>

'use strict';
$(document).ready(function () {
    TableAdvanced.init();
    $(".dataTables_scrollHeadInner .table").addClass("table-responsive");
    $(".dataTables_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
    
    $('[data-toggle="popover"]').popover();

    $('#date_range').daterangepicker({
    showOtherMonths : false,
	showShortcuts: false,
	showTopbar: false,
        "locale": {
            "format": "DD-MM-YYYY",
            "separator": " - ",
            "applyLabel": "Seleccionar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Del",
            "toLabel": "Al",
            "customRangeLabel": "Personalizado",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mie",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "autoApply": true,
        orientation:"bottom",
        autoUpdateInput: false
    },
    );
    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        validarEmpalme();
        return false;
    });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        return false;
    });

});
    
var TableAdvanced = function() {
    // ===============table 1====================
    var initTable1 = function() {
        var table = $('#example');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
        /* Set tabletools buttons and button container */
        table.DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 50, 100, 'All'],
            ],
            dom: 'Bflr<"table-responsive"t>ip',
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa  fa-file-excel-o"></i> Exportar a Excel',
                    filename: 'Cupones',
                    class : 'excel',
                    charset: 'utf-8',
                    bom: true
                },
            
                {
                    extend: 'print',
                    text: '<i class="fa  fa-print"></i> Imprimir',
                    filename: 'Cupones',
                }
            ]
        });
        var tableWrapper = $('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_id}_wrapper
    }
    
    return {
        //main function to initiate the module
        init: function() {
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
            
        }
    };

}();

function convertir_input(id){
    var data = {
        'id':id,
        'unidad_principal': $('#unidad_principal'+id).val(),
        'unidad_secundaria':$('#unidad_secundaria'+id).val(),
        'conversion' : $('#conversion'+id).val(),
        'etiqueta' : $('#etiqueta'+id).val()
    };

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
                timer: 2000,
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
</script>
