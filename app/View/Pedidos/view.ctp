<?php
    echo $this->Html->css(
        array(
            '/admin/css/pages/invoice',
        ),
        array('inline'=>false)
    );
    echo $this->Html->script('/admin/js/qr/jquery.min',array('inline'=>true));
    echo $this->Html->script('/admin/js/qr/qrcode',array('inline'=>true));
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
        ),
        array('inline'=>false)
    );

    $estados_pedido = array(
        2=> 'Pedido Solicitado',
        3=> 'Pedido por Surtir',
        4=> 'Pedido por Enviar',
        5=> 'Pedido Enviado',
        6=> 'Pedido Finalizado',
        7=> 'Solicitud de Cancelación / Devolución',
        8=> 'En Proceso de cancelación / devolución',
        9=> 'Pedido Cancelado',
    );

    $estados_color = array(
        2=> 'green',
        3=> 'green',
        4=> 'green',
        5=> 'green',
        6=> 'black',
        7=> 'red',
        8=> 'red',
        9=> 'red'
    );
?>
<style>
#qrcode {
  width:160px;
  height:160px;
  margin-top:15px;
}
</style>

<div id="content" class="bg-container">
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-sm-6">
                    <h4 class="nav_top_align">
                        <i class="fa fa-file" aria-hidden="true"></i>
                        Pedido
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
                            Detalle de Pedido #<?= $pedido['Pedido']['id']?>
                            <div style="float:right;color:<?= $estados_color[$pedido['Pedido']['status']]?>">
                                <?= $estados_pedido[$pedido['Pedido']['status']]?>
                                <?= $this->Html->link('<i class="fa fa-print"></i>',array('controller'=>'pedidos','action'=>'print',$pedido['Pedido']['id']),array('target'=>'_blank','escape'=>false))?>
                            </div>
                        </div>
                        <div class="card-body m-t-35">
                            <div class="row">
                                
                                <div class="col mrg_btm15">
                                    Estatus de Pedido:
                                    <?php 
                                        foreach($estados_pedido as $key => $estado):
                                            if($pedido['Pedido']['status'] < 7 && $key < 7){
                                                if($pedido['Pedido']['status'] >= $key){
                                                    echo ' <i class="fa fa-check-circle fa-lg" style="color:green"></i> <b>'.$estado.'</b> <i class="fa fa-angle-right"></i> ';
                                                }else{
                                                    echo "<small style='color: silver;'>".$estado.'</small> <i class="fa fa-angle-right"></i> ';
                                                }
                                            }
                                        endforeach;
                                        foreach($estados_pedido as $key => $estado):
                                            if($pedido['Pedido']['status'] > 6 && $key > 6){
                                                if($pedido['Pedido']['status'] >= $key){
                                                    echo ' <i class="fa fa-check-circle fa-lg" style="color:green"></i> <b>'.$estado.'</b> <i class="fa fa-angle-right"></i> ';
                                                }else{
                                                    echo "<small style='color: silver;'>".$estado.'</small> <i class="fa fa-angle-right"></i> ';
                                                }
                                            }
                                        endforeach;
                                        if ($pedido['Pedido']['status']==1){
                                            echo ' <i class="fa fa-times-circle fa-lg" style="color:red"></i> <b style="color:red"> Pedido Cancelado </b> <i class="fa fa-angle-right"></i> ';
                                        }
                                        if($this->Session->read('Auth.User.link_editar_pedido')){
                                            echo $this->Html->link('<i class="fa fa-edit"></i>','javascript:editarEstatus()',array('escape'=>false));
                                        }
                                    ?>
                                    <br />
                                    Fecha de Pedido :
                                    <strong><?= date("d/m/Y H:i:s",strtotime($pedido['Pedido']['fecha_pedido']))?></strong>
                                    <br />
                                    Fecha de Surtido :
                                    <strong><?= $pedido['Pedido']['fecha_surtido']!=null ? date("d/m/Y H:i:s",strtotime($pedido['Pedido']['fecha_surtido'])) : "Por Surtir" ?></strong>
                                    <br />
                                    Fecha de Salida de Almacen :
                                    <strong><?= $pedido['Pedido']['fecha_salida_almacen']!=null ?  date("d/m/Y H:i:s",strtotime($pedido['Pedido']['fecha_salida_almacen'])): "Por Entregar"?></strong>
                                    <br />
                                    Fecha de Entrega :
                                    <strong><?= $pedido['Pedido']['fecha_entrega']!=null ?  date("d/m/Y H:i:s",strtotime($pedido['Pedido']['fecha_entrega'])): "Por Entregar"?></strong>
                                    <br />
                                    Forma de Pago:
                                    <strong>
                                        <?php 
                                            switch($pedido['Pedido']['forma_pago']):
												case 1:
													echo "Efectivo contra entrega";
												break;
												case 2:
													echo "Pago con tarjeta a la entrega";
												break;
												case 3:
													echo "Recibir link de pago";
												break;
												default:
													echo "Tarjeta terminación: * ".$pedido['Pedido']['forma_pago'];
											endswitch;
                                        ?>    
                                    </strong>
                                    <br />
                                    Información de Pago:
                                    <strong>Fecha Pago: <?= $pedido['Pedido']['fecha_pago']?> / No. Autorización: <?= $pedido['Pedido']['numero_transaccion']?></strong>
                                    <br />
                                    Notas de Pedido:
                                    <?php if($pedido['Pedido']['notas_adicionales'] != ''){ ?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong><?= $pedido['Pedido']['notas_adicionales']?></strong>
                                    </div>
                                    <?php }else{ ?>
                                    <strong>No hay notas</strong>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col invoice_body_billing_details">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <div class="invoice_details">
                                                <h4 class="success_txt">Detalles de la cuenta:</h4>
                                                <strong><?= $pedido['User']['nombres']." ".$pedido['User']['apellido_paterno']." ".$pedido['User']['apellido_materno']?></strong>
                                                <br />
                                                Teléfono 1: <?= $pedido['User']['celular']?>
                                                <br />
                                                Teléfono 2: <?= $pedido['User']['telefono']?>
                                                <br />
                                                Correo Electónico: <?= $pedido['User']['email']?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="invoice_details">
                                            <h4 class="success_txt">Información de Envío:</h4>
                                                <strong><?= $pedido['Pedido']['nombre_pedido']?></strong>
                                                <br />
                                                Calle y Número: <?= $pedido['Pedido']['calle_envio']." ".$pedido['Pedido']['numero_exterior_envio']." ".($pedido['Pedido']['numero_interior_envio']!=""?$pedido['Pedido']['numero_interior_envio']:"")?>
                                                <br />
                                                <?= $pedido['Pedido']['direccion_adicional']?>
                                                <br />
                                                Horario de Entrega: <?= $pedido['Pedido']['horario_entrega']?>
                                                <br />
                                                Teléfono 1: <?= $pedido['Pedido']['telefono1_contacto']?>
                                                <br />
                                                Teléfono 2: <?= $pedido['Pedido']['telefono2_contacto']?>
                                                <br />
                                                Correo Electónico: <?= $pedido['Pedido']['email_contacto']?>
												<br>
												 Forma de Pago:
												<strong>
													<?php 
														switch($pedido['Pedido']['forma_pago']):
															case 1:
																echo "Efectivo contra entrega";
															break;
															case 2:
																echo "Pago con tarjeta a la entrega";
															break;
															case 3:
																echo "Recibir link de pago";
															break;
															default:
																echo "Tarjeta terminación: * ".$pedido['Pedido']['forma_pago'];
														endswitch;
													?>    
												</strong>
												<br />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php if($pedido['Pedido']['status']==3){ // Se abre forma para consolidar pedido?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <strong>Resumen de Compra</strong>
                                            </div>
                                            <div class="card-body m-t-35">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <td>
                                                                <strong>#</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Producto</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Cantidad Solicitada</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Cantidad Por entregar en Unidad real</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Cantidad Entregada</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Precio Unitario</strong>
                                                            </td>
                                                            <td class="text-right">
                                                                <strong>Total</strong>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $total = 0;?>
                                                            <?php $x=0?>
                                                            <?php 
                                                                foreach($pedido['Productos'] as $producto):
                                                                $x++;
                                                                if($producto['pedidos_productos']['observaciones'] == '0'){
                                                                    if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                        $observaciones = 'HEINEKEN VIDRIO';
                                                                    }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                        $observaciones = 'XX LAGGER VIDRIO';
                                                                    }
                                                                }else if($producto['pedidos_productos']['observaciones'] == '1'){
                                                                    if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                        $observaciones = 'ULTRA LATA';
                                                                    }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                        $observaciones = 'BOHEMIA CLARA';
                                                                    }
                                                                }else{
                                                                    $observaciones = $producto['pedidos_productos']['observaciones'];
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?= $x?></td>
                                                                    <td><?= $producto['nombre']?><br><b><span style="font-size:15px;" class="badge badge-success"><?= $observaciones?></span></b></td>
                                                                    <td><?= $producto['pedidos_productos']['cantidad_solicitada'].'/'.$producto['pedidos_productos']['unidad_solicitada']?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($producto['pedidos_productos']['unidad_solicitada']==$producto['unidad_principal']){
                                                                                echo $producto['pedidos_productos']['cantidad_solicitada'].$producto['pedidos_productos']['unidad_solicitada'];
                                                                            }else{
                                                                                //echo ($producto['precio_venta']*$producto['conversion']*$producto['pedidos_productos']['cantidad_solicitada']).$producto['pedidos_productos']['unidad_solicitada'];
																				echo ($producto['conversion']*$producto['pedidos_productos']['cantidad_solicitada']).$producto['unidad_principal'];
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $this->Form->input('cantidad_real',array('label'=>['text'=>$producto['unidad_principal'],'style'=>'float:right'],'value'=>$producto['pedidos_productos']['cantidad_enviada'],'id'=>'q'.$producto['pedidos_productos']['id'],'onchange'=>'javascript:saveRow('.$producto['pedidos_productos']['id'].')'))?>
                                                                    </td>
                                                                    <td class="text-center">$<?= number_format(($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'])+number_format($producto['pedidos_productos']['ieps_solicitado'])/$producto['pedidos_productos']['cantidad_solicitada'],2)?></td>
                                                                    <td class="text-right">$<?= $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'];?></td>
                                                                </tr>
                                                            <?php $total += $producto['pedidos_productos']['monto_solicitado']+number_format($producto['pedidos_productos']['iva_solicitado'],2)+$producto['pedidos_productos']['ieps_solicitado'] ?>
                                                            <?php endforeach?>
                                                        <tr>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>Subtotal &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                <strong>$<?= number_format($total,2)?></strong>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                            $descuento = $pedido['Pedido']['descuento'];
                                                            if($pedido['Pedido']['cupon']!=""){
                                                        ?>
                                                            <tr>
                                                                <td class="emptyrow">
                                                                    <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                                </td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow text-right">
                                                                    <strong>Descuento &nbsp;</strong>
                                                                </td>
                                                                <td class="highrow text-right">
                                                                     <?php 
                                                                     $total_descuento = $total - $descuento;
                                                                        /* if($cupon['Cupon']['tipo_descuento'] == 1){
                                                                            $total_descuento = $total - $cupon['Cupon']['monto'];
                                                                            $descuento = '- $'.$cupon['Cupon']['monto'];
                                                                        }else{
                                                                            $total_descuento = $total - (($cupon['Cupon']['monto']/100)*$total);
                                                                            $descuento = '- %'.$cupon['Cupon']['monto'];
                                                                        } */
                                                                    ?>
                                                                    <strong>- $<?= $descuento ?></strong>
                                                                </td>
                                                            </tr>
                                                        <?php }else{
															$total_descuento = $total - $descuento;
														} ?>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>+ Envío &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                
                                                                <strong>$<?= $pedido['Pedido']['envio'] ?></strong> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>Total &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                
                                                                <strong>$<?= number_format(($total_descuento)+$pedido['Pedido']['envio'],2)?></strong> 
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($pedido['Pedido']['status']<6){?>
                                        <div class="col-lg-6 col-sm-6">
                                            <a href="#" style="color:#fff;" class="btn button-alignment btn-danger m-t-15" data-toggle="modal" data-target="#cancelar_pedido">
                                                Cancelar Pedido
                                            </a>
                                        </div>
                                    <?php }?>
                                    <?php if($pedido['Pedido']['status']<5){?>
                                        <div class="col-lg-6 col-sm-6 m-t-15" style="text-align:right">
                                            <?= $this->Form->create('Pedido',array('url'=>array('controller'=>'pedidos','action'=>'updateStatus')))?>
                                            <?= $this->Form->input('comentario'.$pedido['Pedido']['status'],array('style'=>'width:100%','type'=>'text','class'=>'form-element','label'=>false,'placeholder'=>'Comentarios')) ?>
                                            <?= $this->Form->hidden('pedido_id',array('value'=>$pedido['Pedido']['id']))?>
                                            <?= $this->Form->hidden('status',array('value'=>$pedido['Pedido']['status']+1))?>
                                            <span class="pull-sm-right">
                                                <?php echo $this->Form->submit('Pasar pedido a: '.$estados_pedido[$pedido['Pedido']['status']+1],array('class'=>'btn button-alignment btn-success m-t-15','confirm'=>'¿Deseas pasar este pedido a: '.$estados_pedido[$pedido['Pedido']['status']+1]."?"))?>
                                            </span>
                                            <?= $this->Form->end()?>
                                        </div>
                                    <?php }?>
                                    <?php if($pedido['Pedido']['status']==5){?>
                                        <div class="col-lg-6 col-sm-6" style="text-align:right">
                                            <div id="qrcode" style="float:right">Escanear para confirmar entrega</div>
                                        </div>
                                    <?php }?>
                                </div>
                            <?php }else if($pedido['Pedido']['status']==8){ // Se abre forma para devolver pedido?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-white">
                                            <strong>Resumen de Compra</strong>
                                        </div>
                                        <div class="card-body m-t-35">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                    <tr>
                                                        <td>
                                                            <strong>#</strong>
                                                        </td>
                                                        <td>
                                                            <strong>Producto</strong>
                                                        </td>
                                                        <td>
                                                            <strong>Cantidad Solicitada</strong>
                                                        </td>
                                                        <td>
                                                            <strong>Cantidad Enviada</strong>
                                                        </td>
                                                        <td>
                                                            <strong>Cantidad Por Devolver</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>Precio Unitario</strong>
                                                        </td>
                                                        <td class="text-right">
                                                            <strong>Total</strong>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $total = 0;?>
                                                        <?php $x=0?>
                                                        <?php 
                                                            foreach($pedido['Productos'] as $producto):
                                                            $x++;
                                                            if($producto['pedidos_productos']['observaciones'] == '0'){
                                                                if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                    $observaciones = 'HEINEKEN VIDRIO';
                                                                }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                    $observaciones = 'XX LAGGER VIDRIO';
                                                                }
                                                            }else if($producto['pedidos_productos']['observaciones'] == '1'){
                                                                if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                    $observaciones = 'ULTRA LATA';
                                                                }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                    $observaciones = 'BOHEMIA CLARA';
                                                                }
                                                            }else{
                                                                $observaciones = $producto['pedidos_productos']['observaciones'];
                                                            }?>
                                                            <tr>
                                                                <td><?= $x?></td>
                                                                <td><?= $producto['nombre']?><br><b><span style="font-size:15px;" class="badge badge-success"><?= $observaciones?></span></b></td>
                                                                <td><?= $producto['pedidos_productos']['cantidad_solicitada'].$producto['pedidos_productos']['unidad_solicitada']?></td>
                                                                <td><?= $producto['pedidos_productos']['cantidad_enviada'].$producto['pedidos_productos']['unidad_enviada']?></td>
                                                                <td>
                                                                    <?= $this->Form->input('cantidad_real',array('label'=>['text'=>$producto['unidad_principal'],'style'=>'float:right'],'value'=>$producto['pedidos_productos']['cantidad_devuelta'],'id'=>'q'.$producto['pedidos_productos']['id'],'onchange'=>'javascript:saveRowDevolucion('.$producto['pedidos_productos']['id'].')'))?>
                                                                </td>
                                                                <td class="text-center">$<?= number_format(($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'])/$producto['pedidos_productos']['cantidad_solicitada'],2)?></td>
                                                                <td class="text-right">$<?= number_format($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'],2)?></td>
                                                            </tr>
                                                        <?php $total += $producto['pedidos_productos']['monto_solicitado']; ?>
                                                        <?php endforeach?>
                                                    <tr>
                                                    <tr>
                                                        <td class="emptyrow">
                                                            <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                        </td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow text-right">
                                                            <strong>Subtotal &nbsp;</strong>
                                                        </td>
                                                        <td class="highrow text-right">
                                                            <strong>$<?= number_format($total,2)?></strong>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                            $descuento = $pedido['Pedido']['descuento'];
                                                            if($pedido['Pedido']['cupon']!=""){
                                                        ?>
                                                            <tr>
                                                                <td class="emptyrow">
                                                                    <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                                </td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow text-right">
                                                                    <strong>Descuento &nbsp;</strong>
                                                                </td>
                                                                <td class="highrow text-right">
                                                                     <?php 
                                                                     $total_descuento = $total - $descuento;
                                                                        /* if($cupon['Cupon']['tipo_descuento'] == 1){
                                                                            $total_descuento = $total - $cupon['Cupon']['monto'];
                                                                            $descuento = '- $'.$cupon['Cupon']['monto'];
                                                                        }else{
                                                                            $total_descuento = $total - (($cupon['Cupon']['monto']/100)*$total);
                                                                            $descuento = '- %'.$cupon['Cupon']['monto'];
                                                                        } */
                                                                    ?>
                                                                    <strong>- $<?= $descuento ?></strong>
                                                                </td>
                                                            </tr>
                                                        <?php }else{
															$total_descuento = $total - $descuento;
														} ?>
                                                    <tr>
                                                         <td class="emptyrow">
                                                             <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                         </td>
                                                         <td class="emptyrow"></td>
                                                         <td class="emptyrow"></td>                                                         <td class="emptyrow text-right">
                                                             <strong>+ Envío &nbsp;</strong>
                                                         </td>
                                                         <td class="highrow text-right">
                                                             <strong>$<?= $pedido['Pedido']['envio'] ?></strong> 
                                                         </td>
                                                     </tr>
                                                    <tr>
                                                        <td class="emptyrow">
                                                            <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                        </td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow"></td>
                                                        <td class="emptyrow text-right">
                                                            <strong>Total &nbsp;</strong>
                                                        </td>
                                                        <td class="highrow text-right"> 
                                                            <strong>$<?= number_format(($total_descuento)+$pedido['Pedido']['envio'],2)?></strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 m-t-15" style="text-align:right">
                                    <?= $this->Form->create('Pedido',array('url'=>array('controller'=>'pedidos','action'=>'procesarDevolucion')))?>
                                    <?= $this->Form->input('comentario9',array('style'=>'width:100%','type'=>'text','class'=>'form-element','label'=>false,'placeholder'=>'Comentarios')) ?>
                                    <?= $this->Form->hidden('id',array('value'=>$pedido['Pedido']['id']))?>
                                    <?= $this->Form->hidden('status',array('value'=>$pedido['Pedido']['status']+1))?>
                                    <span class="pull-sm-right">
                                        <?php echo $this->Form->submit('Procesar reingreso a inventarios',array('class'=>'btn button-alignment btn-success m-t-15','confirm'=>'¿Deseas devolver los productos a inventario?'))?>
                                    </span>
                                    <?= $this->Form->end()?>
                                </div>
                            </div>
                            <?php }else{?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <strong>Resumen de Compra</strong>
                                            </div>
                                            <div class="card-body m-t-35">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <td>
                                                                <strong>#</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Producto</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Cantidad Solicitada</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Cantidad Entregada</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <strong>Precio Unitario</strong>
                                                            </td>
                                                            <td class="text-right">
                                                                <strong>Total</strong>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $total = 0;?>
                                                            <?php $x=0?>
                                                            <?php 
                                                                foreach($pedido['Productos'] as $producto):
                                                                $x++;
                                                                if($producto['pedidos_productos']['observaciones'] == '0'){
                                                                    if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                        $observaciones = 'HEINEKEN VIDRIO';
                                                                    }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                        $observaciones = 'XX LAGGER VIDRIO';
                                                                    }
                                                                }else if($producto['pedidos_productos']['observaciones'] == '1'){
                                                                    if($producto['pedidos_productos']['producto_id'] == 2180){
                                                                        $observaciones = 'ULTRA LATA';
                                                                    }else if($producto['pedidos_productos']['producto_id'] == 2179){
                                                                        $observaciones = 'BOHEMIA CLARA';
                                                                    }
                                                                }else{
                                                                    $observaciones = $producto['pedidos_productos']['observaciones'];
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?= $x?></td>
                                                                    <td><?= $producto['nombre']?><br><b><span style="font-size:15px;" class="badge badge-success"><?= $observaciones?></span></b></td>
                                                                    <td><?= $producto['pedidos_productos']['cantidad_solicitada'].$producto['pedidos_productos']['unidad_solicitada']?></td>
                                                                    <td><?= $producto['pedidos_productos']['cantidad_enviada'].$producto['pedidos_productos']['unidad_enviada']?></td>
                                                                    <td class="text-center">$<?= number_format(($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'])/$producto['pedidos_productos']['cantidad_solicitada'],2)?></td>
                                                                    <td class="text-center">$<?= number_format($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'],2)?></td> 
                                                                </tr>
                                                            <?php $total += $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'] + $producto['pedidos_productos']['ieps_solicitado']?> 
                                                            <?php endforeach?>
                                                        <tr>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>Subtotal &nbsp;</strong> 
                                                            </td>
                                                            <td class="highrow text-right">
                                                                <strong>$<?= number_format($total,2)?></strong>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                            $descuento = $pedido['Pedido']['descuento'];
                                                            if($pedido['Pedido']['cupon']!=""){
                                                        ?>
                                                            <tr>
                                                                <td class="emptyrow">
                                                                    <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                                </td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow"></td>
                                                                <td class="emptyrow text-right">
                                                                    <strong>Descuento &nbsp;</strong>
                                                                </td>
                                                                <td class="highrow text-right">
                                                                     <?php 
                                                                     $total_descuento = $total - $descuento;
                                                                        /* if($cupon['Cupon']['tipo_descuento'] == 1){
                                                                            $total_descuento = $total - $cupon['Cupon']['monto'];
                                                                            $descuento = '- $'.$cupon['Cupon']['monto'];
                                                                        }else{
                                                                            $total_descuento = $total - (($cupon['Cupon']['monto']/100)*$total);
                                                                            $descuento = '- %'.$cupon['Cupon']['monto'];
                                                                        } */
                                                                    ?>
                                                                    <strong>- $<?= $descuento ?></strong>
                                                                </td>
                                                            </tr>
                                                        <?php }else{
															$total_descuento = $total - $descuento;
														} ?>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                         
                                                            <td class="emptyrow text-right">
                                                                <strong>+ Envío &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                
                                                                <strong>$<?= $pedido['Pedido']['envio'] ?></strong> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>Total &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                <strong>$<?= number_format($total_descuento+$pedido['Pedido']['envio'],2)?></strong>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($pedido['Pedido']['status']<6){?>
                                        <div class="col-lg-6 col-sm-6">
                                            <a href="#" style="color:#fff;" class="btn button-alignment btn-danger m-t-15" data-toggle="modal" data-target="#cancelar_pedido">
                                                Cancelar Pedido
                                            </a>
                                        </div>
                                    <?php }?>
                                    <?php if($pedido['Pedido']['status']==7){?>
                                        <div class="col-lg-6 col-sm-6">
                                            <a href="#" style="color:#fff;" class="btn button-alignment btn-danger m-t-15" data-toggle="modal" data-target="#autorizar_cancelacion_pedido">
                                                Autorizar Cancelación / Devolución de  Pedido
                                            </a>
                                            <?= $this->Html->link('Ver Evidencia',$pedido['Pedido']['evidencia_cancelacion'],array('class'=>'btn button-alignment btn-primary m-t-15','target'=>'_blank'))?>
                                        </div>
                                    <?php }?>
                                    <?php if($pedido['Pedido']['status']<5){?>
                                        <div class="col-lg-6 col-sm-6 m-t-15" style="text-align:right">
                                            <?= $this->Form->create('Pedido',array('url'=>array('controller'=>'pedidos','action'=>'updateStatus')))?>
                                            <?= $this->Form->input('comentario'.$pedido['Pedido']['status'],array('style'=>'width:100%','type'=>'text','class'=>'form-element','label'=>false,'placeholder'=>'Comentarios')) ?>
                                            <?= $this->Form->hidden('pedido_id',array('value'=>$pedido['Pedido']['id']))?>
                                            <?= $this->Form->hidden('status',array('value'=>$pedido['Pedido']['status']+1))?>
                                            <span class="pull-sm-right">
                                                <?php echo $this->Form->submit('Pasar pedido a: '.$estados_pedido[$pedido['Pedido']['status']+1],array('class'=>'btn button-alignment btn-success m-t-15','confirm'=>'¿Deseas pasar este pedido a: '.$estados_pedido[$pedido['Pedido']['status']+1]."?"))?>
                                            </span>
                                            <?= $this->Form->end()?>
                                        </div>
                                    <?php }?>
                                    <?php if($pedido['Pedido']['status']==5){?>
                                        <div class="col-lg-6 col-sm-6" style="text-align:right">
                                            <div id="qrcode" style="float:right">Escanear para confirmar entrega</div>
                                        </div>
                                    <?php }?>
                                </div>
                            <?php }?>
                            <div class="row">
                                <div class="col mrg_btm15 m-t-35">
                                    <table class="table table-sm">
                                        <tr><th colspan="4" STYLE="TEXT-ALIGN:CENTER">BITÁCORA DE PEDIDO</th></tr>
                                        <tr>
                                            <th>Etapa</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Comentarios</th>
                                        </tr>
                                        <?php 
                                            foreach($estados_pedido as $key => $item):
                                                if($pedido['Pedido']['c_e_d_'.$key]!=""){
                                        ?>
                                            <tr>
                                                <td><?= $item?></td>
                                                <td><?= ($pedido['Pedido']['c_e_d_'.$key]=="" ? "" : date("d/M/Y H:i:s",strtotime($pedido['Pedido']['c_e_d_'.$key])))?></td>
                                                <td><?= $pedido['Pedido']['c_e_'.$key]?></td>
                                                <td><?= $pedido['Pedido']['comentario'.$key]?></td>
                                            </tr>
                                        <?php 
                                                }
                                            endforeach;
                                        ?>
                                    </table>
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
    <!-- Modal -->
    <div class="modal fade" id="cancelar_pedido" tabindex="-1" role="dialog" aria-hidden="true">
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Cancelar Pedido
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->Form->create('Pedido',array('url'=>array('action'=>'cancelar','controller'=>'pedidos'),'type'=>'file'))?>
                    <?= $this->Form->input('comentario7',array('required'=>true,'class'=>'form-control','type'=>'text','label'=>'Motivo de Cancelación'))?>
                    <?= $this->Form->input('evidencia',array('required'=>true,'class'=>'form-control','type'=>'file'))?>
                    <?= $this->Form->hidden('id',array('value'=>$pedido['Pedido']['id']))?>
                    <div class="modal-actions">
                        <?= $this->Form->submit('Comenzar Proceso de Cancelación',array('class'=>'btn button-alignment btn-danger m-t-15'))?>
                    </div>
                </div>
                <?= $this->Form->end()?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="autorizar_cancelacion_pedido" tabindex="-1" role="dialog" aria-hidden="true">
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Autorizar Cancelar Pedido
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->Form->create('Pedido',array('url'=>array('action'=>'autorizar_cancelar','controller'=>'pedidos'),'type'=>'file'))?>
                    <?= $this->Form->input('comentario8',array('class'=>'form-control','type'=>'text','label'=>'Consideraciones / Observaciones'))?>
                    <?= $this->Form->hidden('id',array('value'=>$pedido['Pedido']['id']))?>
                    <div class="modal-actions">
                        <?= $this->Form->submit('Autorizar Proceso de Cancelación',array('class'=>'btn button-alignment btn-danger m-t-15'))?>
                    </div>
                </div>
                <?= $this->Form->end()?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar_estatus" tabindex="-1" role="dialog" aria-hidden="true">
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Cambiar de estatus el pedidos
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <?= $this->Form->create('Pedido',array('url'=>array('action'=>'updateStatus','controller'=>'pedidos')))?>
                        <?= $this->Form->input('status',array('class'=>'form-control','type'=>'select','options'=>$estados_pedido))?>
                        <?= $this->Form->input('comentario',array('style'=>'width:100%','type'=>'text','class'=>'form-element','placeholder'=>'Comentarios')) ?>
                        <?= $this->Form->hidden('pedido_id',array('value'=>$pedido['Pedido']['id']))?>
                    <div class="modal-actions">
                        <?= $this->Form->submit('Realizar cambio de estado',array('class'=>'btn button-alignment btn-success m-t-15'))?>
                    </div>
                </div>
                
                <?= $this->Form->end()?>
            </div>
        </div>
    </div>

    <script>

        function editarEstatus(){
            $('#editar_estatus').modal('show');
        }

        function saveRow(row){
            //alert(document.getElementById('q'+row).value);
            var id = row;
            var cantidad = document.getElementById('q'+row).value;
            if(cantidad){
                var dataString = "id="+id+"&cantidad="+cantidad;
                $.ajax({
                    type: "POST",
                    url: '<?php echo Router::url(array("controller" => "pedidos", "action" => "confirmar_cantidad"), TRUE); ?>' ,
                    data: dataString,
                    cache: false,
                    success: function(html) {

                    } 
                });
            }
        }

        function saveRowDevolucion(row){
            //alert(document.getElementById('q'+row).value);
            var id = row;
            var cantidad = document.getElementById('q'+row).value;
            if(cantidad){
                var dataString = "id="+id+"&cantidad="+cantidad;
                $.ajax({
                    type: "POST",
                    url: '<?php echo Router::url(array("controller" => "pedidos", "action" => "devolver_cantidad"), TRUE); ?>' ,
                    data: dataString,
                    cache: false,
                    success: function(html) {

                    } 
                });
            }
        }

        var qrcode = new QRCode(
            "qrcode",
            {
                text:'<?= Router::url(array("controller" => "pedidos", "action" => "confirm_entrega",$pedido["Pedido"]["id"]), TRUE); ?>',
                width:120,
                height:120
            }
        );

        function makeCode () {    
            qrcode.makeCode();
        }

        makeCode();

    </script>