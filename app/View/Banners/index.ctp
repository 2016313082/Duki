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
                        <i class="fa fa-file-image-o"></i>
                        Banners
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
                            <i class="fa fa-table"> </i> Lista de Banners
                            <div style="float:right">
                        <a href="#" style="color:#fff;" class="btn button-alignment btn-success m-t-15" data-toggle="modal" data-target="#nuevo_banner">
                            + Nuevo Banner
                        </a>
                    </div>
                        </div>
                        <div class="card-body">
                            <div class="m-t-35">
                                    <table id="example" class="table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Vista Previa</th>
                                            <th>Titulo</th>
                                            <th>Subtítulo</th>
                                            <th>Texto</th>
                                            <th>URL</th>
                                            <th>Eliminar Banner</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($banners as $banner):?>
                                            <tr>
                                                <td><?= $this->Html->image($banner['Banner']['imagen'],array('style'=>'height:50px')) ?></td>
                                                <td><?= $banner['Banner']['titulo1']?></td>
                                                <td><?= $banner['Banner']['titulo2']?></td>
                                                <td><?= $banner['Banner']['texto1']?></td>
                                                <td><?= $this->Html->link($banner['Banner']['liga'],$banner['Banner']['liga'],array('target'=>'_blank'))?></td>
                                                <td style="text-align:center"><?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('controller'=>'banners','action' => 'delete', $banner['Banner']['id']), array('escape'=>false, 'style'=>'color:red','confirm'=>"¿Deseas eliminar definitivamente el banner ".$banner['Banner']['titulo1']."?")); ?></td>
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

<div class="modal fade" id="nuevo_banner" role="dialog" aria-labelledby="modalLabelsuccess">
    <div class="modal-dialog" role="document">
        <?= $this->Form->create('Banner',array('url'=>array('controller'=>'banners','action'=>'add'),'type'=>'file'))?>
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="modalLabelsuccess">Subir Cupón</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->Form->input('imagen',array('class'=>'form-control','label'=>'Imagen (1920 x 660)','type'=>'file'))?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->input('titulo1',array('class'=>'form-control','label'=>'Titulo'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('titulo2',array('class'=>'form-control','label'=>'Subtitulo'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('texto1',array('class'=>'form-control','label'=>'Texto'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('cta_label',array('class'=>'form-control','label'=>'Texto Botón'))?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->input('liga',array('class'=>'form-control','label'=>'URL'))?>
                    </div>
                    <div class="col-md-12">
                        <p>Vista ejemplo de ubicación de textos</p>
                        <?= $this->Html->image('banners/preview_banner.png',array('style'=>'width:100%'))?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->Form->submit('Subir Banner',array('class'=>'btn  btn-success'))?>
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
