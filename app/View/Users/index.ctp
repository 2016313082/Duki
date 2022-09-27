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
                        <i class="fa fa-users"></i>
                        Usuarios
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
                            <i class="fa fa-table"> </i> Lista de Usuarios
                            <div style="float:right">
                                <?= $this->Html->link('+ Crear Usuario Nuevo',array('controller'=>'users','action'=>'add'),array('class'=>'btn button-alignment btn-success'))?>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y:scroll">
                            <div class="m-t-35">
                                    <table id="example" class="table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Calular</th>
                                            <th>Teléfono</th>
                                            <th>Editar</th>
                                            <th>Dar de baja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $baja = "";
                                            foreach($usuarios as $usuario):
                                                if($usuario['User']['activo']==0){
                                                    $baja = "background-color:rgb(254, 213, 213)";
                                                }
                                        ?>
                                            <tr style="<?= $baja?>">
                                                <td><?= $usuario['User']['nombres']." ".$usuario['User']['apellido_paterno']." ".$usuario['User']['apellido_materno'] ?></td>
                                                <td><?= $usuario['User']['email'] ?></td>
                                                <td><?= $usuario['User']['celular'] ?></td>
                                                <td><?= $usuario['User']['telefono'] ?></td>
                                                <td><?= $this->Html->link('<i class="fa fa-edit"</i>',array('action'=>'edit',$usuario['User']['id']),array('escape'=>false))?></td>
                                                <td>
                                                    <?php
                                                    if($usuario['User']['activo']==0){
                                                        echo $this->Form->postLink('<i class="fa fa-check"></i>', array('controller'=>'users','action' => 'baja', $usuario['User']['id'],1), array('escape'=>false, 'confirm'=>'¿Deseas reactivar al usuario '.$usuario['User']['nombres']." ".$usuario['User']['apellido_paterno']." ".$usuario['User']['apellido_materno'])); 
                                                    }else{
                                                        echo $this->Form->postLink('<i class="fa fa-times"></i>', array('controller'=>'users','action' => 'baja', $usuario['User']['id'],0), array('escape'=>false, 'confirm'=>'¿Deseas dar de baja al usuario '.$usuario['User']['nombres']." ".$usuario['User']['apellido_paterno']." ".$usuario['User']['apellido_materno'])); 
                                                    }
                                                ?></td>
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

<?php $this->Html->scriptStart(array('inline' => false));?>

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
        autoUpdateInput: false,
             
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
                },
           
                
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


<?php $this->Html->scriptEnd();?>
