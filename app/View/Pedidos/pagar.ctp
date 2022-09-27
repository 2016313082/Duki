<?= $this->Html->script('validators',array('inline'=>false)) ?>
<div class="container-sm">
    <div class="overlay d-none">
        <div class="spinner"></div>
        <div class="leyenda"><h5>Estamos procesando tu pago</h5></div>
    </div>
</div>
<style>

</style>
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area" style="background-image: url(../img/banners/banner_login.png)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1>Finalizar Compra</h1>
                    <ul class="breadcrumb-links">
                        <li><?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                        <li>Finalizar compra</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- checkout area start -->
<script>var idcp = <?= json_encode($carrito['Pedido']['cp_id_envio'])?></script>
<?= $this->Form->create('Pedido')?>
<div class="checkout-area mt-60px mb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Información de Envío</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12" id="select_direcciones">
                            <label for="direcciones_guardadas">Rellena los campos direcciones anteriores</label>
                            <select class="form-control" id="direcciones_guardadas"></select>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <?= $this->Form->input('nombre_pedido',array('onchange'=>'javascript:validateSubmit()','required'=>'required','value'=>$this->Session->read('Auth.User.nombres')." ".$this->Session->read('Auth.User.apellido_paterno')." ".$this->Session->read('Auth.User.apellido_materno'),'type'=>'text','label'=>'Nombre Completo','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-6 col-md-12">
                        <?= $this->Form->input('calle_envio',array('onchange'=>'javascript:validateSubmit()','required'=>'required','value'=>$carrito['Pedido']['calle_envio'],'type'=>'text','label'=>'Calle','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->Form->input('privada',array('type'=>'text','label'=>'Privada','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->Form->input('numero_exterior_envio',array('onchange'=>'javascript:validateSubmit()','required'=>'required','value'=>$carrito['Pedido']['numero_exterior_envio'],'type'=>'text','label'=>'Número Exterior','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->Form->input('numero_interior_envio',array('value'=>$carrito['Pedido']['numero_interior_envio'],'type'=>'text','label'=>'Número Interior','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-12 col-sm-12">
						    <script>var id_cps = <?= $_COOKIE['id_cp']?>;</script>
                            <?= $this->Form->input('cp_id',array('class'=>'form-control','onchange'=>'javascript:validateSubmit()','required'=>'required','type'=>'select','div'=>'billing-info mb-20px','label'=>'Codigo Postal, Colonia, Municipio','empty'=>'Buscar tu Código Postal, Colonia o Municipio','options'=>$cps))?>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <?= $this->Form->input('telefono1_contacto',array('onchange'=>'javascript:validateSubmit()','required'=>'required','value'=>$this->Session->read('Auth.User.celular'),'type'=>'text','label'=>'Celular de Contacto','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <?= $this->Form->input('telefono2_contacto',array('onchange'=>'javascript:validateSubmit()','value'=>$this->Session->read('Auth.User.telefono'),'type'=>'text','label'=>'Teléfono 2 de Contacto','div'=>'billing-info mb-20px'))?>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <?= $this->Form->input('email_contacto',array('onchange'=>'javascript:validateSubmit()','required'=>'required','value'=>$this->Session->read('Auth.User.email'),'type'=>'text','label'=>'Correo Electrónico','div'=>'billing-info mb-20px'))?>
                        </div>
                    </div>
                    <?php if($this->Session->read('Auth.User.id')==null){?>
                        <div class="checkout-account mb-50px">
                            <input class="checkout-toggle2" type="checkbox" />
                            <label>Create an account?</label>
                        </div>
                        <div class="checkout-account-toggle open-toggle2 mb-30">
                            <input placeholder="Email address" type="email" />
                            <input placeholder="Password" type="password" />
                            <button class="btn-hover checkout-btn" type="submit">register</button>
                        </div>
                    <?php }?>
                    <div class="additional-info-wrap">
                        <h4>Información adicional para la entrega</h4>
                            <?= $this->Form->input('notas_adicionales',array('type'=>'textarea','placeholder'=>'Referencias, Instrucciones de llegada, o alguna otra información que nos quieras compartir.','div'=>'additional-info'))?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="your-order-area">
                    <h3>Resumen de Pedido</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Productos</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul class="your-order-product">
                                    <?php
                                    $total = 0;
                                    $contador_mezcal = 0;
                                    $contador_cervezas = 0;
                                    $total_mezcal = 0;
                                    $total_cerveza = 0;
                                    $total_mezcales = 0;
                                    $total_cervezas = 0;
                                    $mensaje_cerveza = '';
                                    $mensaje_mezcal = '';
                                    foreach ($carrito['Productos'] as $producto) :
                                        $total += $producto['pedidos_productos']['monto_solicitado'] + $producto['pedidos_productos']['iva_solicitado'] + $producto['pedidos_productos']['ieps_solicitado'];
                                        if($producto['id'] == 918 || $producto['id'] == 919 || $producto['id'] == 920){
                                            $contador_mezcal = $contador_mezcal + $producto['pedidos_productos']['cantidad_solicitada'];
                                            $total_mezcal += $producto['pedidos_productos']['monto_solicitado'] + $producto['pedidos_productos']['iva_solicitado'] + $producto['pedidos_productos']['ieps_solicitado'];
                                        }else if($producto['id'] == 601 || $producto['id'] == 602 || $producto['id'] == 603 || $producto['id'] == 604 || $producto['id'] == 605 || $producto['id'] == 606 || $producto['id'] == 607 || $producto['id'] == 609 || $producto['id'] == 610 || $producto['id'] == 612 || $producto['id'] == 613 || $producto['id'] == 615 || $producto['id'] == 616 || $producto['id'] == 617 || $producto['id'] == 618 || $producto['id'] == 619 || $producto['id'] == 620 || $producto['id'] == 621 || $producto['id'] == 622 || $producto['id'] == 623 || $producto['id'] == 626 || $producto['id'] == 627 || $producto['id'] == 628){
                                            $contador_cervezas = $contador_cervezas + $producto['pedidos_productos']['cantidad_solicitada'];
                                            $total_cerveza += $producto['pedidos_productos']['monto_solicitado'] + $producto['pedidos_productos']['iva_solicitado'] + $producto['pedidos_productos']['ieps_solicitado'];
                                        }
                                    ?>
                                        <li><span style="font-size:75%" class="order-middle-left"><?= $producto['nombre']?> X <?= $producto['pedidos_productos']['cantidad_solicitada']." ".$producto['pedidos_productos']['unidad_solicitada']?></span> <span style="font-size:75%" class="float-left">$<?= number_format($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'],2)?> </span></li>
                                    <?php endforeach?>
									<input id="monto" name="monto" form="3ds-form" type="text" value="<?= number_format($total,2)?>" hidden /> 
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <?php
                                $promociones_cervezas = intdiv($contador_cervezas,6);
                                    if($contador_cervezas > 0 && $promociones_cervezas > 0){
                                        $porcentaje_cervezas = 0.30;
                                        $total_cervezas = ($total_cerveza * $porcentaje_cervezas);
                                        $mensaje_cerveza = "<span style='color: red;'>- 30% en cervezas</span> <span>$".$total_cervezas."</span>";
                                    }
                                    if($contador_mezcal > 0){
                                        $promociones_mezcal = intdiv($contador_mezcal,2);
                                        $total_mezcales = $promociones_mezcal * 135;
                                        $mensaje_mezcal = "<span style='color: red;'>- 15% en mezcales</span> <span>$".$total_mezcales."</span>" ;
                                    }
                                    if (isset($cupon['Cupon']['cupon'])) {
                                ?>
                                    <ul>
                                        <li class="order-total">Descuento</li>
                                        <li>
                                            <?php
                                            $descuento = 0;
                                            $label = "";
                                            if ($cupon['Cupon']['tipo_descuento'] == 1) { //Descuento en Monto directo
                                                $descuento = $cupon['Cupon']['monto'];
                                                $label = "- $" . number_format($cupon['Cupon']['monto'], 2) . " pesos";
                                            } else { //Descuento en %
                                                $descuento = $total * ($cupon['Cupon']['monto'] / 100);
                                                $label = "-" . $cupon['Cupon']['monto'] . "%";
                                            }
                                            $total = $total - $descuento;
                                            //$total = $total - $total_cervezas - $total_mezcales;
                                            $gran_descuento = $descuento;
                                            ?>
                                            <?= $cupon['Cupon']['cupon'] . "</br><small style='color:red'>" . $label . "</small>" ?>
                                        </li>
                                    </ul>
                                <?php } 
                                    $gran_descuento = $total_cervezas + $total_mezcales;
                                    $total = $total - $total_cervezas - $total_mezcales;
                                ?>
                                <?= $mensaje_cerveza?>
                                <?='</br>'. $mensaje_mezcal ?>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <li class="your-order-shipping titulo_pago">Envío y horario de entrega <span id="precio_envio"></span> </li>
                                </ul>
                                <ul>
                                    <li class="your-order-shipping">Envío: Estándar <?= date('Y-m-d H');?></li>
                                </ul>
                                <?php
                                    if(date("N") == 6 || date("N") == 7){
                                        $horas= array(
                                            4  => '9am a 10am',
                                            8  => '10am a 1pm',
                                            10 => '1pm a 3pm',
                                            12 => '3pm a 4pm',
                                            //13 => '5pm a 7pm',
                                            //15 => '7pm a 9pm'
                                            //15 => '7pm a 9pm' El horario 13 es hasta las 7pm lo baje a las 6pm
                                        );

                                        $dia_siguiente = array(
                                            4  => '9am a 10am',
                                            8  => '10am a 1pm',
                                            10 => '1pm a 3pm',
                                            12 => '3pm a 4pm',
                                            //13 => '5pm a 7pm',
                                            //15 => '7pm a 9pm'
                                            //15 => '7pm a 9pm' El horario 13 es hasta las 7pm lo baje a las 6pm
                                        );
                                        $ahora = date('H');
                                        $horarios = array();
                                        //if(date("H")<20 && date("H")>6){
                                            //este if es para cerrar express a las 3:30 pm
                                        if(strtotime(date("H:i"))<strtotime("15:30") && date("H")>6){ 
                                            array_push(
                                                $horarios, 
                                                array(
                                                    'Pedido Express'=>'Pedido Express (40 minutos)' 
                                                )
                                            );
                                        } 
                                    }else{

                                        $horas= array(
                                            4  => '8am a 10am',
                                            8  => '10am a 12pm',
                                            10 => '1pm a 3pm',
                                            12 => '3pm a 5pm',
                                            13 => '5pm a 7pm',
                                            15 => '7pm a 9pm'
                                            //15 => '7pm a 9pm' El horario 13 es hasta las 7pm lo baje a las 6pm
                                        );

                                        
                                        if(date("N") == 5){
                                            $dia_siguiente = array(
                                                4  => '8am a 10am',
                                                8  => '10am a 1pm',
                                                10 => '1pm a 3pm',
                                                12 => '3pm a 3:30pm',
                                                //13 => '5pm a 7pm',
                                                //15 => '7pm a 9pm'
                                                //15 => '7pm a 9pm' El horario 13 es hasta las 7pm lo baje a las 6pm
                                            );
                                        }else{
                                            $dia_siguiente = array(
                                                4  => '8am a 10am',
                                                8  => '10am a 12pm',
                                                10 => '1pm a 3pm',
                                                12 => '3pm a 4pm',
                                                13 => '5pm a 7pm',
                                                15 => '7pm a 9pm'
                                                //15 => '7pm a 9pm' El horario 13 es hasta las 7pm lo baje a las 6pm
                                            );
                                        }
                                        $ahora = date('H');
                                        $horarios = array();
                                        if(date("H")<20 && date("H")>6){
                                            //este if es para cerrar express a las 3:30 pm
                                        //if(strtotime(date("H:i"))<strtotime("16:20") && date("H")>6){ 
                                            array_push(
                                                $horarios, 
                                                array(
                                                    'Pedido Express'=>'Pedido Express (40 minutos)' 
                                                )
                                            );
                                        } 
                                    }

                                    if($ahora < 4){
                                        $pivot = 4;
                                    }else if($ahora > 15){
                                        $pivot = 16;
                                    }
                                    else{
                                        $pivot = isset($horas[$ahora]) ? $ahora : $ahora+1;
                                    }

                                    foreach($horas as $key => $item){ //Horarios restantes de hoy
                                        if ($key >= $pivot){
                                            array_push(
                                                $horarios,
                                                array(
                                                    date("d-M")." ".$item=>date("d-M")." ".$item
                                                )
                                            );
                                        }
                                    }
                                    
                                    foreach($dia_siguiente as $key => $item){ //Todos los horarios del día siguiente
                                        array_push(
                                            $horarios,
                                            array(
                                                date("d-M",strtotime("+1 day"))." ".$item=>date("d-M",strtotime("+1 day"))." ".$item
                                            )
                                        );
                                    }
                                ?>
                                <ul>
                                    <li class="your-order-shipping">Horario de Entrega<?= $this->Form->input('horario_entrega',array('onchange'=>'javascript:calculaEnvio()','required'=>'required','type'=>'select','options'=>$horarios,'class'=>'nice-select','label'=>false,'empty'=>'Selecciona un horario'))?></li>
                                    <li class="error_nice_select" id="label_horario_entrega_error" style="display:none">Selecciona un horario de entrega</li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li id="total_label">$<?= number_format($total,2)?></li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <?php
                                        $clase = "color:black";
                                        $letrero = ""; 
                                        if(isset($error_pago)){
                                            $clase = "color:red";
                                            $letrero =  "Intentar con otro medio de pago";
                                        }
                                    ?>
                                    <li class="your-order-shipping titulo_pago" style="<?= $clase?>">Forma de Pago <?= $letrero ?></li>
                                </ul>
                                <ul>
                                    <li class="your-order-shipping">Forma de Pago<?= $this->Form->input('metodo_pago_id',array('onchange'=>'javascript:showCvv()','required'=>'required','type'=>'select','options'=>$tarjetas,'class'=>'nice-select','label'=>false,'empty'=>'Selecciona una tarjeta'))?></li>
                                    <li style="display:none" id="cvv" class="your-order-shipping">CVV / CVC <?= $this->Form->input('cvv',array('type'=>'password','label'=>false))?></li>
                                    <li class="error_nice_select" id="label_forma_pago_error" style="display:none">Selecciona una forma de pago</li>
                                </ul>
                            </div>
                            <div class="Place-order mt-25">
								<?= $this->Form->input('tyc',array('style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Confirmo y acepto realizar mi pedido a DUKI','style'=>"margin-left:5px"),'type'=>"checkbox",'onclick'=>'javascript:validateSubmit()'))?>
                                <button class="cart-btn-2" id="submit_btn" type="submit">Finalizar Compra</button>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end()?>
<!-- checkout area end -->
<!-- Modal -->
<div class="modal fade" id="modal-tarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar tarjeta</h5>
      </div>
      <div class="modal-body">
        <form id="agregar-tarjeta" action="/duki_pruebas/metodosPagos/addViewPagar" method="post">
            <div class="form-row">
                <div class="col-sm-8 col-12">
                    <label for="numero-tarjeta">Numero de tarjeta</label>
                    <input class="form-control" type="number" id="numero-tarjeta" name="data[MetodosPago][numero_tarjeta]" minlength="16" maxlength="16" required>
                    <input hidden id="tipo" name="data[MetodosPago][tipo]">
                </div>
                <div class="col-sm-2 col-6">
                    <label for="mes_vencimiento">Mes vencimiento</label>
                    <input class="form-control" id="mes_vencimiento1" name="data[MetodosPago][mes_vencimiento]">
                </div>
                <div class="col-sm-2 col-6">
                    <label for="anio_vencimiento">Año vencimiento</label>
                    <input class="form-control" id="anio_vencimiento1" name="data[MetodosPago][anio_vencimiento]">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-4 col-12">
                    <label for="nombre">Nombre(s) del tarjetahabiente</label>
                    <input class="form-control" id="nombre1" name="data[MetodosPago][nombre]" value="<?= $this->Session->read('Auth.User.nombres') ?>">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="apellidos">Apellidos del tarjetahabiente</label>
                    <input class="form-control" id="apellidos1" name="data[MetodosPago][apellidos]" value="<?= $this->Session->read('Auth.User.apellido_paterno').' '.$this->Session->read('Auth.User.apellido_materno')?>">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="cvv">CVV</label>
                    <input class="form-control" id="cvv1" name="data[MetodosPago][cvv]">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-4 col-12">
                    <label for="calle_numero">Calle y número</label>
                    <input class="form-control" id="calle_numero1" name="data[MetodosPago][calle_numero]" value="<?= $carrito['Pedido']['calle_envio'].' '.$carrito['Pedido']['numero_exterior_envio'] ?>">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="colonia">Colonia</label>
                    <input class="form-control" id="colonia1" name="data[MetodosPago][colonia]" value="">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="municipio">Municipio</label>
                    <input class="form-control" id="municipio1" name="data[MetodosPago][municipio]">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-4 col-4">
                    <label for="cp1">Código postal</label>
                    <input class="form-control" id="cp1" name="data[MetodosPago][cp]">
                </div>
                <div class="col-sm-4 col-8">
                    <label for="estado1">Estado</label>
                    <input class="form-control" id="estado1" name="data[MetodosPago][estado]">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="pais1">Pais</label>
                    <input class="form-control" id="pais1" name="data[MetodosPago][pais]">
                </div>
            </div>
        </form>
      </div>
		<div class="container">
			<div class="form-row mt-4">
				<div class="col-sm-6 col-12">
					<button type="button" class="btn btn-danger form-control" data-dismiss="modal">Cerrar</button>
				</div>
				<br>
				<div class="col-sm-6 col-12">	
					<button type="submit" class="btn btn-success form-control" form="agregar-tarjeta">Guardar</button>
				</div>	
			</div>
		</div>
		<br>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	promocion();
	$("#PedidoCpId option[value="+id_cps+"]").attr("selected",true);
	
    traer_direcciones();
	validateSubmit();
    $('#direcciones_guardadas').on('change',function(){
        $.ajax({
            'url' : base_url + 'direccions/traer_direccion',
            'type' : 'post',
            'data' : {'id' : this.value},
            'datatype' : 'json',
            'success' : function(obj){
                console.log(obj);
                $('#PedidoCalleEnvio').val(obj.Direccion.calle);
                $('#PedidoPrivada').val(obj.Direccion.privada);
                $('#PedidoNumeroExteriorEnvio').val(obj.Direccion.numero_exterior);
                $('#PedidoNumeroInteriorEnvio').val(obj.Direccion.numero_interior);
                $('#PedidoCpId').val(obj.Direccion.cp_id);
            }
        })
    });
	
    $('.overlay').addClass('d-none');
    $('#submit_btn').hide();
    PedidoCpId
    $("#PedidoCpId").chosen();
    $("#PedidoCpId").val(<?= $carrito['CP']['id']?>);
    $("#PedidoCpId").trigger("chosen:updated");
	
	$('#agregar-tarjeta').on('submit',function(e){
        e.preventDefault();
        switch (creditCardType($('#numero-tarjeta').val())){
            case ('MASTERCARD'):
                $('#tipo').val('MC');
            break;
            case ('AMEX'):
                $('#tipo').val('AMEX');
            break;
            case ('VISA'):
               $('#tipo').val('VISA');
            break;
            default:
                alert("Esta tarjeta es inválida. Favor de probar con otra numeración");
            break;
        }
        $.ajax({    
            'url' : base_url + 'metodosPagos/addViewPagar',
            'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
            'success': function(obj){
                $('#modal-tarjeta').modal('hide');
                if(obj.resultado == true){
                    swal.fire({
                        'icon' : 'success',
                        'title' : 'Tu tarjeta se ha registrado correctamente',
                    }).then((result) => {
                        if (result.isConfirmed) {
                          location.reload();
                        }
                    })
                    
                }else{
                    swal.fire({
                        'icon' : 'error',
                        'title' : 'No se pudo registrar la tarjeta  ',
                    });
                }
            }
        })
    });
});

function traer_direcciones(){
    var contDirec = '';
    $.ajax({
        'url': base_url + 'direccions/contar_direcciones',
        'datatype' : 'json',
        'success' : function(obj){
            if(obj == 0){
                $('#select_direcciones').addClass('d-none');
            }else{
                var contDirec = '';
                $.ajax({
                    'url': base_url + 'direccions/ver_direcciones',
                    'datatype' : 'json',
                    'success' : function(obj){
                        contDirec += '<option selected disabled>Selecciona una dirección guardada</option>';
                        $.each(obj,function(i,elemento){
                            contDirec += '<option value="'+elemento.Direccion.id+'">'+elemento.Direccion.nombre+'</option>';
                        });
                        $('#direcciones_guardadas').prepend(contDirec);
                    }
                });
            }
        }
    })
}

$('#PedidoPagarForm').on('submit',function(e){
    $('.duki_carga').removeClass('d-none'); 
})

function showCvv(){
    
    if (document.getElementById('PedidoMetodoPagoId').value < 4){
        document.getElementById('cvv').style.display="none";
    }else{
        document.getElementById('cvv').style.display="";
    }
    validateSubmit();
    //alert(document.getElementById('PedidoMetodoPagoId').value);
}

function validateSubmit(){
    var completo = true;

    document.getElementById('PedidoNombrePedido').classList.remove("error_llenar");
    document.getElementById('PedidoCalleEnvio').classList.remove("error_llenar");
    document.getElementById('PedidoNumeroExteriorEnvio').classList.remove("error_llenar");
    document.getElementById('PedidoCpId').classList.remove("error_llenar");
    document.getElementById('PedidoTelefono1Contacto').classList.remove("error_llenar");
    //document.getElementById('PedidoTelefono2Contacto').classList.remove("error_llenar");
    document.getElementById('PedidoEmailContacto').classList.remove("error_llenar");
    document.getElementById('label_horario_entrega_error').style.display="none";
    document.getElementById('label_forma_pago_error').style.display="none";
    

    if(document.getElementById('PedidoNombrePedido').value==""){
        completo = false;
        document.getElementById('PedidoNombrePedido').classList.add("error_llenar");
    }
    if(document.getElementById('PedidoCalleEnvio').value==""){
        completo = false;
        document.getElementById('PedidoCalleEnvio').classList.add("error_llenar");
    }
    if(document.getElementById('PedidoNumeroExteriorEnvio').value==""){
        completo = false;
        document.getElementById('PedidoNumeroExteriorEnvio').classList.add("error_llenar");
    }
    
    if(document.getElementById('PedidoCpId').value==""){
        completo = false;
        document.getElementById('PedidoCpId_chosen').classList.add("error_llenar");
    }

    if(document.getElementById('PedidoTelefono1Contacto').value==""){
        completo = false;
        document.getElementById('PedidoTelefono1Contacto').classList.add("error_llenar");
    }
    
    /* if(document.getElementById('PedidoTelefono2Contacto').value==""){
        completo = false;
        document.getElementById('PedidoTelefono2Contacto').classList.add("error_llenar");
    } */

    if(document.getElementById('PedidoEmailContacto').value==""){
        completo = false;
        document.getElementById('PedidoEmailContacto').classList.add("error_llenar");
    }

    if(document.getElementById('PedidoHorarioEntrega').value==""){
        completo = false;
        document.getElementById('label_horario_entrega_error').style.display='';
    }

    if(document.getElementById('PedidoMetodoPagoId').value==""){
        completo = false;
        document.getElementById('label_forma_pago_error').style.display='';
    }
    
    if(!document.getElementById('PedidoTyc').checked){
        completo = false;
    }

    if(completo){
        $('#submit_btn').show();
        //document.getElementById('submit_btn').style.display="";
    }else{
        $('#submit_btn').hide();
        //document.getElementById('submit_btn').style.display="none";
    }
}

function calculaEnvio(){
	var total = <?= $total?>;
	var envio = 0;
	if(document.getElementById('PedidoHorarioEntrega').value=="Pedido Express"){
		if(total >= 899){
			$("#PedidoMetodoPagoId option[value='1']").remove();
			$("#PedidoMetodoPagoId option[value='2']").remove();
			$("#PedidoMetodoPagoId option[value='3']").remove();
			$('#PedidoMetodoPagoId').append('<option value="1">Efectivo en la entrega</option>');
			$('#PedidoMetodoPagoId').append('<option value="2">Pago con tarjeta a la entrega</option>');
			$('#PedidoMetodoPagoId').append('<option value="3">Quiero recibir link de pago a mi correo</option>');
			$('#PedidoMetodoPagoId').niceSelect('update');
			document.getElementById('precio_envio').innerHTML = "Envío Gratis";
		}else{
			document.getElementById('precio_envio').innerHTML = "$69.00";
			envio = 69;
		}
	}else if(document.getElementById('PedidoHorarioEntrega').value=="Dia de las madres"){
		//$('#PedidoMetodoPagoId').remove(); 
		$("#PedidoMetodoPagoId option[value='1']").remove();
		$("#PedidoMetodoPagoId option[value='2']").remove();
		$("#PedidoMetodoPagoId option[value='3']").remove();
		$('#PedidoMetodoPagoId').append('<option value="3">Quiero recibir link de pago a mi correo</option>');
		$('#PedidoMetodoPagoId').niceSelect('update');
		document.getElementById('precio_envio').innerHTML = "Envío Gratis";
	}else{
		$("#PedidoMetodoPagoId option[value='1']").remove();
		$("#PedidoMetodoPagoId option[value='2']").remove();
		$("#PedidoMetodoPagoId option[value='3']").remove();
		$('#PedidoMetodoPagoId').append('<option value="1">Efectivo en la entrega</option>');
		$('#PedidoMetodoPagoId').append('<option value="2">Pago con tarjeta a la entrega</option>');
		$('#PedidoMetodoPagoId').append('<option value="3">Quiero recibir link de pago a mi correo</option>');
		$('#PedidoMetodoPagoId').niceSelect('update');
		if(total >= 499){
			document.getElementById('precio_envio').innerHTML = "Envío Gratis";
		}else{
			document.getElementById('precio_envio').innerHTML = "$49.00";
			envio = 49;
		}
	}
	document.getElementById('total_label').innerHTML = "";
	document.getElementById('total_label').innerHTML = new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(total+envio);
	$('#monto').val('');
	$('#monto').val(total+envio);
	validateSubmit();
}

function promocion(){
        var gran_descuento = <?= $gran_descuento?>;
        var id_pedido = <?= $carrito['Pedido']['id'] ?>;
        $.ajax({
            'url' : base_url + 'pedidos/nuevo_descuento',
            'type' : 'post',
            'data' : {
                'descuento' : gran_descuento,
                'id_pedido' : id_pedido
            },
            'datatype' : 'json',
            'success' : function(obj){
                console.log(obj);
            }
        }) 
    }
</script>
