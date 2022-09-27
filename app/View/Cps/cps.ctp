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
            '/admin/vendors/datatables/js/datatables.min',
            //'/admin/vendors/datatables/js/jquery.dataTables.min',
            //'/admin/vendors/datatables/js/dataTables.bootstrap.min',
            '/admin/js/pages/advanced_tables',
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
<script>
    var base_url = "<?= Router::url('/', true); ?>";
</script>
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Codigos Postales
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
                <div class="container-fluid">
                <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-10 col-sm-10">

                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                            Agregar un codigo postal
                                            </button>
                                        </h5>
                                        </div>
                                        <br>
                                        <div id="collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                            <br>
                                                <form class="row" id="agregar">
                                                    <div class="form-group col-md-6">
                                                        <label>Codigo postal</label>
                                                        <input type="text" class="form-control" id="cp" name="cp">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Colonia</label>
                                                        <input type="text" class="form-control" id="colonia" name="colonia">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Municipio</label>
                                                        <input type="text" class="form-control" id="municipio" name="municipio">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Estado</label>
                                                        <input type="text" class="form-control" id="estado" name="estado">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success fa fa-plus" aria-hidden="true">  Agregar  </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <table id="tabla_cps_data" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <th>Id</th>
                                        <th>Codigo postal</th>
                                        <th>Colonia</th>
                                        <th>Municipio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody id="tabla_cps">    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualiza Codigo postal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editar">
          <div class="form-group">
            <label for="Id" class="col-form-label">Id</label>
            <input type="text" class="form-control" id="idEdit" name="id" readOnly>
          </div>
          <div class="form-group">
            <label for="nombreEdit" class="col-form-label">Codigo postal</label>
            <input class="form-control" id="cpEdit" name="cp"></input>
          </div>
          <div class="form-group">
            <label for="nombreEdit" class="col-form-label">Colonia</label>
            <input class="form-control" id="coloniaEdit" name="colonia"></input>
          </div>
          <div class="form-group">
            <label for="nombreEdit" class="col-form-label">Municipio</label>
            <input class="form-control" id="municipioEdit" name="municipio"></input>
          </div>
          <div class="form-group">
            <label for="nombreEdit" class="col-form-label">Estado</label>
            <input class="form-control" id="estadoEdit" name="estado"></input>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->Html->script('morris.min.js'); ?>
<?= $this->Html->script('morris-data.js'); ?>
<?= $this->Html->script('admin/cps.js'); ?>