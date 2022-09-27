<?= $this->Html->css('bootstrap.min.css'); ?>
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
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">...</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h1>Tags de productos</h1>
                    <div class="container">
                        <div class="form-row">
                            <div class="col-6 col-sm-6">
                                <button class="btn btn-success btn-block">Agregar tag<button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h1>Horarios Duki</h1>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
                </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer
    Dar de alta a los compradores
    Login - registro (Generar credenciales por parte interna)
-->
</div>
<?= $this->Html->script('morris.min.js'); ?>
<?= $this->Html->script('morris-data.js'); ?>
<?= $this->Html->script('admin/dashboard.js'); ?>