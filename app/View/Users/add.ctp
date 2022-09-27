<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-user"></i>
                        Agregar Usuario
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
                        <?= $this->Form->create('User')?>
                        <div class="card-body" style="overflow-y:scroll">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $this->Form->input('nombres',array('class'=>'form-control','label'=>'Nombres'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('apellido_paterno',array('class'=>'form-control','label'=>'Apellido Paterno'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('apellido_materno',array('class'=>'form-control','label'=>'Apellido Materno'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('email',array('class'=>'form-control','label'=>'Email (Será el nombre de usuario)'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('password',array('class'=>'form-control','label'=>'Contraseña','type'=>'password'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('telefono',array('class'=>'form-control','label'=>'Teléfono'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('celular',array('class'=>'form-control','label'=>'Celular'))?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 m-t-35">
                                    <h4>Permisos</h4>
                                    <?= $this->Form->input('link_clientes',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver la lista de clientes','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_productos',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Productos','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_banners',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Banners','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_cupones',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Cupones','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_newsletters',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver inscritos al Boletín','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_usuarios',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede administrar Usuarios','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                </div>
                                <div class="col-md-3 m-t-35">
                                    <h4>Acciones Pedidos</h4>
                                    <?= $this->Form->input('p1',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Solicitados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p2',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos por Surtir','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p3',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos por Envíar','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p4',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Enviados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p5',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Finalizado','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p6',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Cancelados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                </div>
                                <div class="col-md-12">
                                    <?= $this->Form->submit('Guardar Cambios',array('class'=>'btn btn-success'))?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>