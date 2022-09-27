<?php
    echo $this->Html->css(
        array(
            '/admin/css/pages/invoice',
            '/admin/vendors/datatables/css/dataTables.bootstrap.min',
            '/admin/css/pages/dataTables.bootstrap',
            '/admin/css/pages/tables',
            '/admin/vendors/datatables/css/colReorder.bootstrap.min',
        ),
        array('inline'=>false)
    );
    echo $this->Html->script(
        array(
            '/admin/vendors/select2/js/select2',
            '/admin/vendors/datatables/js/jquery.dataTables.min',
            '/admin/vendors/datatables/js/dataTables.bootstrap.min',
            //'/admin/js/pages/advanced_tables',
            '/admin/js/pluginjs/dataTables.tableTools',
            '/admin/vendors/datatables/js/dataTables.colReorder',
            '/admin/vendors/datatables/js/dataTables.buttons.min',
            '/admin/vendors/datatables/js/dataTables.responsive.min',
            '/admin/vendors/datatables/js/dataTables.rowReorder.min',
            '/admin/vendors/datatables/js/buttons.colVis.min',
            '/admin/vendors/datatables/js/buttons.html5.min',
            '/admin/vendors/datatables/js/buttons.bootstrap.min',
            '/admin/vendors/datatables/js/buttons.print.min',
            '/admin/vendors/datatables/js/dataTables.scroller.min',
        ),
        array('inline'=>false)
    );

    $estados_pedido = array(
        2=> 'Pedido Solicitado',
        3=> 'Pedido por Surtir',
        4=> 'Pedido por Enviar',
        5=> 'Pedido Enviado',
        6=> 'Pedido Finalizado',
    );

    $estados_color = array(
        2=> 'green',
        3=> 'green',
        4=> 'green',
        5=> 'green',
        6=> 'black',
        7=> 'red'
    );
?>
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-sm-6">
                    <h4 class="nav_top_align">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <?= $cliente['User']['nombres']." ".$cliente['User']['apellido_paterno']." ".$cliente['User']['apellido_materno']?>
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon ion-card qwe" data-pack="default" data-tags="credit, price, debit, money, shopping, cash, dollars, $"></i>
                            Información general
                        </div>
                        <div class="card-body m-t-35">
                            <div class="row">
                                <div class="col mrg_btm15">
                                    Teléfono:
                                    <strong><?= $cliente['User']['telefono']?></strong>
                                    <br />
                                    Celular:
                                    <strong><?= $cliente['User']['celular']?></strong>
                                    <br />
                                    Email:
                                    <strong><?= $cliente['User']['email']?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
    <div class="outer">
        <div class="inner bg-container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon ion-card qwe" data-pack="default" data-tags="credit, price, debit, money, shopping, cash, dollars, $"></i>
                            Lista de Pedidos
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="example" class="table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pedido</th>
                                            <th>Fecha de Pedido</th>
                                            <th>Total de Pedido</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($cliente['Pedidos'] as $pedido): ?>
                                            <tr>
                                                <td><?= $this->Html->link($pedido['id'],array('controller'=>'pedidos','action'=>'view',$pedido['id']))?></td>
                                                <td><?= $pedido['fecha_pedido']!="1969-12-31" || $pedido['fecha_pedido']!=""  ? date("d/m/Y H:i:s",strtotime($pedido['fecha_pedido'])) : "" ?></td>
                                                <td>
                                                    <?php 
                                                        $total = 0;
                                                        foreach($pedido['Productos'] as $producto):
                                                            $total += $producto['pedidos_productos']['monto_solicitado'];
                                                        endforeach;
                                                        echo "$".number_format($total,2);
                                                    ?>
                                                </td>
                                                <td><?= $pedido['fecha_entrega']!="" ? date("d/m/Y H:i:s",strtotime($pedido['fecha_entrega'])) : ""?></td>
                                                <td><?= $estados_pedido[$pedido['status']]?></td>
                                            </tr>
                                        <?php endforeach?>
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
</div>
<?php $this->Html->scriptStart(array('inline' => false));?>

'use strict';
$(document).ready(function () {

    TableAdvanced.init();
    $(".dataTables_scrollHeadInner .table").addClass("table-responsive");
    $(".dataTables_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
    
    $('[data-toggle="popover"]').popover()

});
    
var TableAdvanced = function() {
    // ===============table 1====================
    var initTable1 = function() {
        var table = $('#example');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
        /* Set tabletools buttons and button container */
        table.DataTable({
            dom: 'Bflr<"table-responsive"t>ip',
            paging : false,
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa  fa-file-excel-o"></i> Exportar a Excel',
                    filename: 'Pedidos_<?= $cliente['User']['id']?>',
                    class : 'excel',
                    charset: 'utf-8',
                    bom: true
                },
            
                {
                    extend: 'print',
                    text: '<i class="fa  fa-print"></i> Imprimir',
                    filename: 'Pedidos_<?= $cliente['User']['id']?>',
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