<meta http-equiv="refresh" content="60">
<?php
    echo $this->Html->css(
        array(
            '/admin/vendors/select2/css/select2.min',
            '/admin/vendors/datatables/css/dataTables.bootstrap.min',
            '/admin/css/pages/dataTables.bootstrap',
            '/admin/css/pages/tables',
            '/admin/vendors/datatables/css/colReorder.bootstrap.min',
        ),
        array('inline'=>false)
    );

     $this->Html->script(
        array(
            '/admin/vendors/select2/js/select2',
            '/admin/vendors/datatables/js/jquery.dataTables.min',
            '/admin/vendors/datatables/js/dataTables.bootstrap.min',
            //'/admin/js/pages/advanced_tables',
            '/admin/js/pluginjs/dataTables.tableTools',
            //'/admin/vendors/datatables/js/dataTables.colReorder.min',
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
        1=> 'Carrito',
        2=> 'Pedido Solicitado',
        3=> 'Pedido por Surtir',
        4=> 'Pedido por Enviar',
        5=> 'Pedido Enviado',
        6=> 'Pedido Finalizado',
        7=> 'Pedido Cancelado',
    );
?>
<div id="duki">
    <div id="content" class="bg-container">
        <header class="head">
            <div class="main-bar">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-4 col-sm-4">
                        <h4 class="nav_top_align">
                            <i class="fa fa-th"></i>
                            Pedidos
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
                                <i class="fa fa-table"> </i> Lista de Pedidos DUKI
                                <div style="float:right">
                                    <?= $this->Html->link('Ver Formato MPH','javascript:showMPH(1)',array('style'=>'color:gray;font-size:.8em'))?>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-y:scroll">
                                <div class="m-t-35">
                                    <table id="example" class="table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Folio de Pedido</th>
                                                <th>Nombre de Cliente</th>
                                                <th>Número de Items</th>
                                                <th>Fecha de Pedido</th>
                                                <th>Colonia y Municipio de Entrega</th>
                                                <th>Horario de Entrega</th>
                                                <th>Teléfono de Contacto</th>
                                                <th>Email Contacto</th>
                                                <th>Forma de Pago</th>
                                                <th>Notas adicionales</th>
												<th>Total pedido</th>
                                                <th>Estado de Pedido</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($pedidos as $pedido):
                                                    $estilo = ""; 
                                                    if ($pedido['Pedido']['horario_entrega']=="Pedido Express"){
                                                        $estilo = "background-color:orange";
                                                    }
                                            ?>
                                                
                                                <tr>
                                                    <td><?= $this->Html->link($pedido['Pedido']['id'],array('action'=>'view','controller'=>'pedidos',$pedido['Pedido']['id']))?></td>
                                                    <td><?= $pedido['Pedido']['nombre_pedido']?></td>
                                                    <td><?= sizeof($pedido['Productos'])?></td>
                                                    <td data-sort="<?=$pedido['Pedido']['fecha_pedido']?>"><?= date("d-m-Y H:i:s",strtotime($pedido['Pedido']['fecha_pedido']))?></td>
                                                    <td><?= $pedido['Pedido']['direccion_adicional']?></td>
                                                    <td><?= $pedido['Pedido']['horario_entrega']?></td>
                                                    <td><?= $pedido['Pedido']['telefono1_contacto']?></td>
                                                    <td><?= $pedido['Pedido']['email_contacto']?></td>
                                                    <td><?= $pedido['Pedido']['forma_pago']?></td>
                                                    <td><?= $pedido['Pedido']['notas_adicionales']?></td>
													<td><?= $pedido['Pedido']['subtotal']+$pedido['Pedido']['iva']+$pedido['Pedido']['ieps']-$pedido['Pedido']['descuento']+$pedido['Pedido']['envio']?></td>
                                                    <td><?= $estados_pedido[$pedido['Pedido']['status']]?></td>
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
</div>

<div id="mph" style="display:none">
    <div id="content" class="bg-container">
        <header class="head">
            <div class="main-bar">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-4 col-sm-4">
                        <h4 class="nav_top_align">
                            <i class="fa fa-th"></i>
                            Pedidos
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
                                <i class="fa fa-table"> </i> Lista de Direcciones de Pedidos MPH
                                <div style="float:right">
                                    <?= $this->Html->link('Ver Formato DUKI','javascript:showMPH(0)',array('style'=>'color:gray;font-size:.8em'))?>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-y:scroll">
                                <div class="m-t-35">
                                    <table id="mph_table" class="table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Título*   Requerido</th>
                                                <th>Dirección completa*   Requerido</th>
                                                <th>Carga</th>
                                                <th>Hora inicial</th>
                                                <th>Hora final</th>
                                                <th>Tiempo de servicio</th>
                                                <th>Notas</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                                <th>Id de referencia</th>
                                                <th>Habilidades requeridas</th>
                                                <th>Habilidades Opcionales</th>
                                                <th>Persona de contacto</th>
                                                <th>Teléfono de contacto</th>
                                                <th>Hora inicial 2</th>
                                                <th>Hora final 2</th>
                                                <th>Carga 2</th>
                                                <th>Carga 3</th>
                                                <th>Prioridad</th>
                                                <th>SMS</th>
                                                <th>Correo electrónico de contacto</th>
                                                <th>Carga pick</th>
                                                <th>Carga pick 2</th>
                                                <th>Carga pick 3</th>
                                                <th>Fecha programada</th>
                                                <th>Tipo de visita</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($pedidos as $pedido):
                                                    $direccion = $pedido['Pedido']['calle_envio']." ".$pedido['Pedido']['numero_exterior_envio']." ".($pedido['Pedido']['numero_interior_envio']!="" ? " Int:".$pedido['Pedido']['numero_interior_envio']:"")." ".$pedido['Pedido']['direccion_adicional'];
                                            ?>
                                                
                                                <tr>
                                                    <td><?= "DUKI Pedido: ".$pedido['Pedido']['id']?></td>
                                                    <td><?= $direccion?></td>
                                                    <td></td><td></td><td></td><td></td>
                                                    <td><?= $pedido['Pedido']['notas_adicionales']?></td>
                                                    <td></td><td></td><td></td><td></td><td></td>
                                                    <td><?= $pedido['Pedido']['nombre_pedido']?></td>
                                                    <td><?= $pedido['Pedido']['telefono1_contacto']?></td>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                                    <td><?= $pedido['Pedido']['email_contacto']?></td>
                                                    <td></td><td></td><td></td><td></td><td></td>
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
</div>

<script>
    function showMPH(mph){
        if(mph){
            document.getElementById('mph').style.display="";
            document.getElementById('duki').style.display="none";
        }else{
            document.getElementById('mph').style.display="none";
            document.getElementById('duki').style.display="";
        }
    }
</script>


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
            "scrollY": '300px',
            'order':[[3,'desc']],
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa  fa-file-excel-o"></i> Exportar a Excel',
                    filename: 'Pedidos',
                    class : 'excel',
                    charset: 'utf-8',
                    bom: true
                },
            
                {
                    extend: 'print',
                    text: '<i class="fa  fa-print"></i> Imprimir',
                    filename: 'Pedidos',
                },
            ]
        });
        var tableWrapper = $('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_id}_wrapper
    }

    var initTable2 = function() {
        var table = $('#mph_table');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
        /* Set tabletools buttons and button container */
        table.DataTable({
            dom: 'Bflr<"table-responsive"t>ip',
            "scrollY": '300px',
            'order':[[3,'desc']],
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa  fa-file-excel-o"></i> Exportar a Excel',
                    filename: 'Pedidos',
                    class : 'excel',
                    charset: 'utf-8',
                    bom: true
                },
            
                {
                    extend: 'print',
                    text: '<i class="fa  fa-print"></i> Imprimir',
                    filename: 'Pedidos',
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
            initTable2();
            
        }
    };
}();


<?php $this->Html->scriptEnd();?>