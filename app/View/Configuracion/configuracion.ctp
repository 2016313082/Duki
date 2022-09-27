<script>
    var base_url = "<?= Router::url('/', true); ?>";
</script>
<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                        Configuración
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
                <div class="container-fluid">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tabilst">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tags</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Horarios</a>
                    </div>
                </nav>
                <br>
                <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h1>Tags de productos</h1>
                    <br>
                    <div class="container">
                        <div class="form-row">
                            <div class="col-10 col-sm-10">

                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                            Agregar una etiqueta
                                            </button>
                                        </h5>
                                        </div>
                                        <br>
                                        <div id="collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                            <br>
                                                <form class="form-inline" id="agregar">
                                                    <div class="form-group mb-2">
                                                        <label>Nombre de la etiqueta</label>
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                                    </div>
                                                    <button type="submit" class="btn btn-success mb-2 fa fa-plus" aria-hidden="true" ></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <table id="tabla" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre de etiqueta</th>
                                            <th>Acciones</th>
                                        <tr>
                                    </thead>
                                    <tbody id="tabla_tags">    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <h1>Horarios Duki</h1>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script('morris.min.js'); ?>
<?= $this->Html->script('morris-data.js'); ?>
<?= $this->Html->script('admin/configuracion.js'); ?>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizacion de etiqueta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editar">
          <div class="form-group">
            <label for="Id" class="col-form-label">Id</label>
            <input type="text" class="form-control" id="IdEdit" name="Id" readOnly>
          </div>
          <div class="form-group">
            <label for="nombreEdit" class="col-form-label">Nuevo nombre de etiqueta</label>
            <input class="form-control" id="nombreEdit" name="nombre"></input>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>