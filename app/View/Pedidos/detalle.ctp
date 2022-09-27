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
<style>
#qrcode {
  width:160px;
  height:160px;
  margin-top:15px;
}
</style>

<div id="content" class="bg-container">
    <div class="outer">
        <div class="inner bg-container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon ion-card qwe" data-pack="default" data-tags="credit, price, debit, money, shopping, cash, dollars, $"></i>
                            Detalle de Pedido #<?= $pedido['Pedido']['id']?>
                            <div style="float:right;color:'<?= $estados_color[$pedido['Pedido']['status']]?>'">
                                <?= $estados_pedido[$pedido['Pedido']['status']]?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col invoice_body_billing_details">
                                    <div class="row justify-content-between">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                            $x++;?>
                                                            <tr>
                                                                <td><?= $x?></td>
                                                                <td><?= $producto['nombre']?><br><small><?= $producto['pedidos_productos']['observaciones']?></small></td>
                                                                <td><?= $producto['pedidos_productos']['cantidad_solicitada'].$producto['pedidos_productos']['unidad_solicitada']?></td>
                                                                <td><?= $producto['pedidos_productos']['cantidad_enviada'].$producto['pedidos_productos']['unidad_enviada']?></td>
                                                                <td class="text-center">$<?= number_format(($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'])/$producto['pedidos_productos']['cantidad_solicitada'],2)?></td>
                                                                <td class="text-right">$<?= number_format($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado'],2)?></td>
                                                            </tr>
                                                        <?php $total += $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']; ?>
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
                                                        $descuento = 0;
                                                        if($pedido['Pedido']['cupon']!=""){
                                                    ?>
                                                        <tr>
                                                            <td class="emptyrow">
                                                                <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                                            </td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow text-right">
                                                                <strong>Descuento &nbsp;</strong>
                                                            </td>
                                                            <td class="highrow text-right">
                                                                <?php 
                                                                    $descuento = $cupon['Cupon']['tipo_descuento']==1 ? $cupon['Cupon']['monto'] : ($cupon['Cupon']['tipo_descuento']/100)*$total;
                                                                ?>
                                                                <strong>-$<?= number_format($descuento,2)?></strong>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
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
                                                            <strong>$<?= number_format($total-$descuento,2)?></strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <?= $this->Html->link('Agregar Pedido a Carrito de nuevo',array('controller'=>'pedidos','action'=>'copiar',$pedido['Pedido']['id']),array('class'=>'btn button-alignment btn-success m-t-15'))?>                                </div>
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