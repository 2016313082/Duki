<?= $this->Html->script('validators',array('inline'=>false)) ?>
<?php 
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
    $estados_pedido = array(
        1=>'Carrito',
        2=> 'Pedido Solicitado',
        3=> 'Pedido por Surtir',
        4=> 'Pedido por Enviar',
        5=> 'Pedido Enviado',
        6=> 'Pedido Finalizado',
    );
    
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
?>
<style>
.chosen-container.chosen-container-single {
    width: 100%!important; /* or any value that fits your needs */
}
</style>
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area" style="background-image: url(../img/banners/banner_login.png)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Mi cuenta</h1>
                    <ul class="breadcrumb-links">
                        <li><?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                        <li>Mi cuenta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- account area start -->
<div class="checkout-area mtb-60px">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>1 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Editar mis datos personales</a></h3>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse show">
                                <div class="panel-body">
                                    <?= $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'editar_cuenta')))?>
                                    <?= $this->Form->hidden('id')?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Mi información</h4>
                                            <h5>Modifica los datos de tu cuenta y da clic en Guardar Cambios</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('nombres',array('required'=>true,'type'=>'text','label'=>'Nombres'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('apellido_paterno',array('required'=>true,'type'=>'text','label'=>'Apellido Paterno'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('email',array('required'=>true,'type'=>'text','label'=>'Correo Electrónico'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('celular',array('type'=>'text','label'=>'Celular'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('telefono',array('type'=>'text','label'=>'Teléfono'))?>
                                                </div>
                                            </div>
											 <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    Mi cumpleaños
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('dia',array('label'=>false,'value'=>$this->request->data['User']['cumpleanos']!="" ? number_format(explode("/",$this->request->data['User']['cumpleanos'])[0],0) : "", 'type'=>'number','max'=>31,'step'=>0,'min'=>1,'placeholder'=>'Día '))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <div class="billing-info">
                                                    <?php
                                                        $meses = array(
                                                            '01'=>'Enero',
                                                            '02'=>'Febrero',
                                                            '03'=>'Marzo',
                                                            '04'=>'Abril',
                                                            '05'=>'Mayo',
                                                            '06'=>'Junio',
                                                            '07'=>'Julio',
                                                            '08'=>'Agosto',
                                                            '09'=>'Septiembre',
                                                            '10'=>'Octubre',
                                                            '11'=>'Noviembre',
                                                            '12'=>'Diciembre'
                                                        );
                                                    ?>
                                                    <?= $this->Form->input('mes',array('type'=>'select','options'=>$meses,'selected'=>$this->request->data['User']['cumpleanos']!="" ? explode("/",$this->request->data['User']['cumpleanos'])[1]: "",'label'=>false, 'class'=>'nice-select','empty'=>'Selecciona un Mes'))?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>2 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Cambiar contraseña </a></h3>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?= $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'editar_password')))?>
                                    <?= $this->Form->hidden('id')?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Cambiar Contraseña</h4>
                                            <h5>Ingresa tu nueva contraseña y da clic en Guardar Nueva Contraseña</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                <?= $this->Form->input('password',array('value'=>'','required'=>true,'type'=>'password','label'=>'Nueva Contraseña','id'=>'p1'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('password_2',array('required'=>true,'type'=>'password','label'=>'Confirma Contraseña','id'=>'p2','onchange'=>'javascript:validaPasswords()'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div id="no_coinciden" class="warning-note" style="display:none">Las Contraseñas no coinciden</div>
                                            </div>
                                            <script>
                                                function validaPasswords(){
                                                    //alert(document.getElementById('p1').value == document.getElementById('p2').value);
                                                    if (document.getElementById('p1').value == document.getElementById('p2').value){
                                                        document.getElementById('submit_div').style.display='';
                                                        document.getElementById('no_coinciden').style.display='none';
                                                    }else{
                                                        document.getElementById('submit_div').style.display='none';
                                                        document.getElementById('no_coinciden').style.display='';
                                                    }
                                                }

                                                function editarDireccion(id,nombre,calle,num_ext,num_int,cp_id,privada){
                                                    document.getElementById('edit_direccion').style.display = '';
                                                    document.getElementById('e_id').value = id;
                                                    document.getElementById('e_nombre').value = nombre;
                                                    document.getElementById('e_calle').value = calle;
                                                    document.getElementById('e_next').value = num_ext;
                                                    document.getElementById('e_nint').value = num_int;
													document.getElementById('e_privada').value = privada;
                                                    $('#e_cp').val(cp_id);
                                                    $('#e_cp').trigger("chosen:updated");
                                                }

                                                function editarTarjeta(id,nombre,apellidos,mes,anio,tarjeta,tipo){
                                                    
                                                    document.getElementById('edit_pago').style.display = '';
                                                    document.getElementById('mp_id').value = id;
                                                    document.getElementById('mp_nombre').value = nombre;
                                                    document.getElementById('mp_apellidos').value = apellidos;
                                                    document.getElementById('mp_mes').value = mes;
                                                    document.getElementById('mp_anio').value = anio;
                                                    document.getElementById('numero_tarjeta').innerHTML="";
                                                    document.getElementById('numero_tarjeta').innerHTML=tarjeta+'<img src="/duki_pruebas/img/logo/'+tipo+'" class="credit-card-color" alt="">';
                                                    
                                                }


                                                function showAddDireccion(){
                                                    document.getElementById('add_direccion').style.display='';
                                                }


                                                function hideAdd(){
                                                    document.getElementById('add_direccion').style.display='none';
                                                }

                                                function hideEdit(){
                                                    document.getElementById('edit_direccion').style.display='none';
                                                }

                                                function showAddPago(){
                                                    document.getElementById('add_pago').style.display='';
                                                }

                                                function hideAddPago(){
                                                    document.getElementById('add_pago').style.display='none';
                                                }

                                                function hideEditPago(){
                                                    document.getElementById('edit_pago').style.display='none';
                                                }

                                                function validarCC(){
                                                    document.getElementById('visa').classList.add("credit-card-gray");
                                                    document.getElementById('visa').classList.remove("credit-card-color");
                                                    document.getElementById('mc').classList.add("credit-card-gray");
                                                    document.getElementById('mc').classList.remove("credit-card-color");
                                                    document.getElementById('amex').classList.add("credit-card-gray");
                                                    document.getElementById('amex').classList.remove("credit-card-color");
                                                    switch (creditCardType(document.getElementById('MetodosPagoNumeroTarjeta').value)){
                                                        case ('MASTERCARD'):
                                                            document.getElementById('mc').classList.remove("credit-card-gray");
                                                            document.getElementById('mc').classList.add("credit-card-color");
                                                            document.getElementById('MetodosPagoTipo').value = 'MC';
                                                        break;
                                                        case ('AMEX'):
                                                            document.getElementById('amex').classList.remove("credit-card-gray");
                                                            document.getElementById('amex').classList.add("credit-card-color");
                                                            document.getElementById('MetodosPagoTipo').value = 'AMEX';
                                                        break;
                                                        case ('VISA'):
                                                            document.getElementById('visa').classList.remove("credit-card-gray");
                                                            document.getElementById('visa').classList.add("credit-card-color");
                                                            document.getElementById('MetodosPagoTipo').value = 'VISA';
                                                        break;
                                                        default:
                                                            alert("Esta tarjeta es inválida. Favor de probar con otra numeración");
                                                        break;
                                                    }
                                                }

                                            </script>
                                        </div>
                                        <div class="billing-back-btn" id="submit_div" style="display:none">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Nueva Contraseña</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>3 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Administrar mis Direcciones</a></h3>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body" id='add_direccion' style="display:none">
                                    <?= $this->Form->create('Direccion',array('url'=>array('controller'=>'direccions','action'=>'add')))?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Nueva Dirección <div style="float:right"><?= $this->Html->link('<i class="fa fa-times"></i>','javascript:hideAdd()',array('escape'=>false))?></div></h4>
                                            <h5>Ingresa todos los datos de tu dirección </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('nombre',array('required'=>true,'type'=>'text','label'=>'Nombre','placeholder'=>'Ingresa el alias de la dirección'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('calle',array('required'=>true,'type'=>'text','label'=>'Calle','placeholder'=>'Ingresa la calle de la dirección','required'=>true))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('numero_exterior',array('required'=>true,'type'=>'text','label'=>'Número Exterior','placeholder'=>'Ingresa el número exterior','required'=>true))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('numero_interior',array('type'=>'text','label'=>'Número Interior','placeholder'=>'Ingresa el número interior','required'=>true))?>
                                                </div>
                                            </div>
											<div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('privada',array('required'=>true,'type'=>'text','label'=>'Privada','placeholder'=>'Ingresa la privada (en caso de requerirlo)'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('cp_id',array('type'=>'select','label'=>'Codigo Postal, Colonia, Municipio','empty'=>'Buscar tu Código Postal, Colonia o Municipio','class'=>'chzn-select','options'=>$cps,'required'=>true))?>
                                                </div>
                                            </div>
											
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Direccion</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                                <div class="panel-body" id='edit_direccion' style="display:none">
                                    <?= $this->Form->create('Direccion',array('url'=>array('controller'=>'direccions','action'=>'edit')))?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Editar Dirección <div style="float:right"><?= $this->Html->link('<i class="fa fa-times"></i>','javascript:hideEdit()',array('escape'=>false))?></div></h4>
                                            <h5>Ingresa los nuevos datos de tu dirección </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->hidden('id',array('id'=>'e_id'))?>
                                                    <?= $this->Form->input('nombre',array('id'=>'e_nombre','required'=>true,'type'=>'text','label'=>'Nombre'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('calle',array('id'=>'e_calle','required'=>true,'type'=>'text','label'=>'Calle'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('numero_exterior',array('id'=>'e_next','required'=>true,'type'=>'text','label'=>'Número Exterior'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('numero_interior',array('id'=>'e_nint','type'=>'text','label'=>'Número Interior'))?>
                                                </div>
                                            </div>
											<div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('privada',array('id'=>'e_privada','required'=>true,'type'=>'text','label'=>'Privada','placeholder'=>'Ingresa la privada (en caso de requerirlo)'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('cp_id',array('id'=>'e_cp','type'=>'select','label'=>'Codigo Postal, Colonia, Municipio','empty'=>'Buscar tu Código Postal, Colonia o Municipio','class'=>'chzn-select','options'=>$cps))?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Cambios de Direccion</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                                <div class="panel-body">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Mis Direcciones <div style="float:right"><?= $this->Html->link('<i class="fa fa-plus"></i> Agregar Direccion','javascript:showAddDireccion()',array('escape'=>false))?></div></h4>
                                        </div>
                                        <?php foreach($this->request->data['Direcciones'] as $direccion):?>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <p><b><?=$direccion['nombre']?></b></p>
                                                        <p><?=$direccion['calle']." No.".$direccion['numero_exterior'].($direccion['numero_interior']!=''?' Int. '.$direccion['numero_interior']:"") ?></p>
                                                        <p><?=$direccion['colonia'].", CP".$direccion['cp']?></p>
                                                        <p><?=$direccion['ciudad']?></p>
                                                        <p><?=$direccion['estado']?></p>
                                                        <p><?=$direccion['pais']?></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-edit-delete text-center">
                                                        <?php echo $this->Html->link('Editar',"javascript:editarDireccion(".$direccion['id'].",'".$direccion['nombre']."','".$direccion['calle']."','".$direccion['numero_exterior']."','".$direccion['numero_interior']."',".$direccion['cp_id'].",'".$direccion['privada']."')",array('class'=>'edit')) ?>
                                                        <?php echo $this->Form->postLink('Eliminar', array('controller'=>'direccions','action' => 'delete', $direccion['id']), array('escape'=>false, 'confirm'=>__('¿Deseas eliminar esta dirección?', $direccion['id']))); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach?>
                                        <div class="billing-back-btn">
                                            <div class="billing-back">
                                                <a href="#"><i class="fa fa-arrow-up"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default single-my-account" hidden>
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>4 .</span> <a data-toggle="collapse" data-parent="#faq" href="#mis-pagos">Mis formas de pago</a></h3>
                            </div>
                            <div id="mis-pagos" class="panel-collapse collapse">
                                <div class="panel-body" id='add_pago' style="display:none">
                                    <?= $this->Form->create('MetodosPago',array('url'=>array('controller'=>'metodosPagos','action'=>'add')))?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Nueva Forma de pago <div style="float:right"><?= $this->Html->link('<i class="fa fa-times"></i>','javascript:hideAddPago()',array('escape'=>false))?></div></h4>
                                            <h5>Ingresa todos los datos de tu forma de pago <div style="float:right"><?= $this->Html->image('logo/mc.png',array('class'=>'credit-card-gray','id'=>'mc'))?><?= $this->Html->image('logo/visa.png',array('class'=>'credit-card-gray','id'=>'visa'))?><?= $this->Html->image('logo/amex.png',array('class'=>'credit-card-gray','id'=>'amex'))?></div></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('numero_tarjeta',array('required'=>true,'type'=>'text','label'=>'Número de Tarjeta','maxlength'=>16,'onchange'=>'javascript:validarCC()'))?>
                                                    <?= $this->Form->hidden('tipo')?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('mes_vencimiento',array('required'=>true,'type'=>'text','label'=>'Mes vencimiento','maxlength'=>2))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('anio_vencimiento',array('required'=>true,'type'=>'text','label'=>'Año vencimiento','maxlength'=>2))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('nombre',array('required'=>true,'type'=>'text','label'=>'Nombre de tarjetahabiente'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('apellidos',array('required'=>true,'type'=>'text','label'=>'Apellidos de tarjetahabiente'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('cvv',array('required'=>true,'type'=>'number','label'=>'CVV'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('calle_numero',array('type'=>'text','label'=>'Calle y Número'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('colonia',array('type'=>'text','label'=>'Colonia'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('municipio',array('type'=>'text','label'=>'Municipio'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('cp',array('type'=>'text','label'=>'Código Postal'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('estado',array('type'=>'text','label'=>'Estado'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                <?= $this->Form->input('pais',array('type'=>'text','label'=>'País'))?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Datos de Tarjeta</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                                <div class="panel-body" id='edit_pago' style="display:none">
                                    <?= $this->Form->create('MetodosPago',array('url'=>array('controller'=>'metodos_pagos','action'=>'edit')))?>
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Editar Tarjeta Terminación <span id='numero_tarjeta'></span><div style="float:right"><?= $this->Html->link('<i class="fa fa-times"></i>','javascript:hideEditPago()',array('escape'=>false))?></div></h4>
                                            <h5>Ingresa los nuevos datos de tu tarjeta </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->hidden('id',array('id'=>'mp_id'))?>
                                                    <?= $this->Form->input('nombre',array('id'=>'mp_nombre','required'=>true,'type'=>'text','label'=>'Nombre Tarjetahabiente'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('apellidos',array('id'=>'mp_apellidos','required'=>true,'type'=>'text','label'=>'Apellidos Tarjetahabiente'))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('mes_vencimiento',array('id'=>'mp_mes','required'=>true,'type'=>'text','label'=>'Mes vencimiento','maxlength'=>2))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('anio_vencimiento',array('id'=>'mp_anio','required'=>true,'type'=>'text','label'=>'Año vencimiento','maxlength'=>2))?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="billing-info">
                                                    <?= $this->Form->input('cvv',array('required'=>true,'type'=>'number','label'=>'CVV'))?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-btn">
                                                <button type="submit">Guardar Cambios de Direccion</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end()?>
                                </div>
                                <div class="panel-body">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Mis Tarjetas <div style="float:right"><?= $this->Html->link('<i class="fa fa-plus"></i> Agregar Método de Pago','javascript:showAddPago()',array('escape'=>false))?></div></h4>
                                        </div>
                                        <?php foreach($this->request->data['MetodosPago'] as $pago):?>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <p><?= $this->Html->image('logo/'.$tipos_tarjeta[$pago['tipo']],array('class'=>'credit-card-color'))?><b> Tarjeta que termina en <?=$pago['numero_tarjeta']?></b></p>
                                                        <p>Vigencia: <?= $pago['mes_vencimiento']."/".$pago['anio_vencimiento']?></p>
                                                        <p><?= $pago['nombre'].' '.$pago['apellidos']?></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-edit-delete text-center">
                                                        <?php echo $this->Html->link('Editar',"javascript:editarTarjeta(".$pago['id'].",'".$pago['nombre']."','".$pago['apellidos']."','".$pago['mes_vencimiento']."','".$pago['anio_vencimiento']."','".$pago['numero_tarjeta']."','".$tipos_tarjeta[$pago['tipo']]."')",array('class'=>'edit')) ?>
                                                        <?php echo $this->Form->postLink('Eliminar', array('controller'=>'metodos_pagos','action' => 'delete', $pago['id']), array('escape'=>false, 'confirm'=>__('¿Deseas eliminar esta tarjeta?', $pago['id']))); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default single-my-account">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>4 .</span> <a data-toggle="collapse" data-parent="#faq" href="#mis-pedidos">Mis Pedidos</a></h3>
                            </div>
                            <div id="mis-pedidos" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="myaccount-info-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Mis Pedidos <div style="float:right"></div></h4>
                                        </div>
                                        <table id="example" class="table-striped table-bordered table">
                                            <thead>
                                                <tr>
                                                    <th>Folio de Pedido</th>
                                                    <th>Número de Items</th>
                                                    <th>Fecha de Pedido</th>
                                                    <th>Forma de Pago</th>
                                                    <th>Estado de Pedido</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($pedidos as $pedido):
                                                ?>
                                                    
                                                    <tr>
                                                        <td><?= $this->Html->link($pedido['Pedido']['id'],array('action'=>'detalle','controller'=>'pedidos',$pedido['Pedido']['id']))?></td>
                                                        <td><?= sizeof($pedido['Productos'])?></td>
                                                        <td data-sort="<?=$pedido['Pedido']['fecha_pedido']?>"><?= date("d-m-Y H:i:s",strtotime($pedido['Pedido']['fecha_pedido']))?></td>
                                                        <td><?= $pedido['Pedido']['forma_pago']?></td>
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
            </div>
        </div>
    </div>
</div>
<!-- account area end -->
<?php $this->Html->scriptStart(array('inline' => false));?>

'use strict';
$(document).ready(function () {

    //TableAdvanced.init();
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