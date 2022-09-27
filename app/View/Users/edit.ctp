<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-user"></i>
                        Modificar Usuario
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
                        <?= $this->Form->input('id',array('value'=>$user['User']['id'],'type'=>'hidden'))?>
                        <div class="card-body" style="overflow-y:scroll">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $this->Form->input('nombres',array('value'=>$user['User']['nombres'],'class'=>'form-control','label'=>'Nombres'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('apellido_paterno',array('value'=>$user['User']['apellido_paterno'],'class'=>'form-control','label'=>'Apellido Paterno'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('apellido_materno',array('value'=>$user['User']['apellido_materno'],'class'=>'form-control','label'=>'Apellido Materno'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('email',array('value'=>$user['User']['email'],'class'=>'form-control','label'=>'Email (Será el nombre de usuario)'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('password',array('class'=>'form-control','label'=>'Contraseña','type'=>'password'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('telefono',array('value'=>$user['User']['telefono'],'class'=>'form-control','label'=>'Teléfono'))?>
                                </div>
                                <div class="col-md-3">
                                    <?= $this->Form->input('celular',array('value'=>$user['User']['celular'],'class'=>'form-control','label'=>'Celular'))?>
                                </div>
                                <div class="col-md-3 m-t-35">
                                    <?= $this->Form->input('activo',array('checked'=>$user['User']['activo'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Usuario Activo','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 m-t-35">
                                    <h4>Permisos</h4>
                                    <?= $this->Form->input('link_clientes',array('checked'=>$user['User']['link_clientes'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver la lista de clientes','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_productos',array('checked'=>$user['User']['link_productos'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Productos','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_banners',array('checked'=>$user['User']['link_banners'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Banners','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_cupones',array('checked'=>$user['User']['link_cupones'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede configurar Cupones','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_newsletters',array('checked'=>$user['User']['link_newsletters'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver inscritos al Boletín','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('link_usuarios',array('checked'=>$user['User']['link_usuarios'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede administrar Usuarios','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
									<?= $this->Form->input('link_categorias',array('checked'=>$user['User']['link_categorias'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede administrar categorias','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
									<?= $this->Form->input('link_mercadito',array('checked'=>$user['User']['link_mercadito'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede administrar mercadito','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
									<?= $this->Form->input('link_configuracion',array('checked'=>$user['User']['link_configuracion'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ir a configuración','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                </div>
                                <div class="col-md-3 m-t-35">
                                    <h4>Acciones Pedidos</h4>
                                    <?= $this->Form->input('p1',array('checked'=>$user['User']['p1'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Solicitados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p2',array('checked'=>$user['User']['p2'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos por Surtir','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p3',array('checked'=>$user['User']['p3'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos por Envíar','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p4',array('checked'=>$user['User']['p4'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Enviados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p5',array('checked'=>$user['User']['p5'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Finalizado','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
                                    <?= $this->Form->input('p6',array('checked'=>$user['User']['p6'] ? true : false,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Puede ver Pedidos Cancelados','value'=>1,'style'=>"margin-left:5px"),'type'=>"checkbox"))?>
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