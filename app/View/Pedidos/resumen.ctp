<?= $this->Html->script('validators',array('inline'=>false)) ?>
<style>
.chosen-co  ntainer.chosen-container-single {
    width: 100%!important; /* or any value that fits your needs */
}
.btn-duki-resumen{
	color: #4fb68b;
}
a.btn-duki-resumen:hover {
	background: #4fb68b;
	color: #FFFFFF;
}
@media screen and (max-width: 600px) {
       table {
           width:100%;
       }
       thead {
           display: none;
       }
       tr:nth-of-type(2n) {
           background-color: inherit;
       }
       tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
       }
       tbody td {
           display: block;
           text-align:center;
       }
       tbody td:before {
           content: attr(data-th);
           display: block;
           text-align:center;
       }
}	
</style>
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1>Resumen de Pedido</h1>
                    <ul class="breadcrumb-links">
                        <li><?=$this->Html->link('Inicio',array('controller'=>'pages','action'=>'home'))?></li>
                        <li>Resumen de compra</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<!-- Best Sell Slider Carousel Start -->
<div class="cart-main-area mtb-60px">
    <div class="container">
        <h3 class="cart-page-title">¡Un antojito no está de más!</h3>
        <div class="row">
            <div class="best-sell-slider owl-carousel owl-nav-style">
                <!-- Single Item -->
                <?php foreach($antojos as $producto):?>
                    <?= $this->Element('Productos/grid_view',array('producto'=>$producto['productos'],'tipo'=>'antojos','categoria_id'=>$antojos[0]['productos_categorias']['categoria_id']))?>
                <?php endforeach?>
                <!-- Single Item -->
            </div>
        </div>
    </div>
</div>
<!-- Best Sells Carousel End -->

<!-- cart area start -->	
<div class="cart-main-area mtb-60px">
    <div class="container">
        <h3 class="cart-page-title">Tus productos</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead class="theader">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-carrito"></tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <?php echo $this->Form->postLink('VACIAR CARRITO DE COMPRA', array('controller'=>'pedidos','action' => 'clear'), array('class'=>'warning','escape'=>false, 'confirm'=>'¿Estás seguro de vacíar tu carrito de compras?')); ?>
                                </div>
                                <div class="cart-clear">
                                    <?= $this->Html->link('Seguir Comprando',array('controller'=>'pages','action'=>'home'))?>
                                </div>
								<div class="cart-clear">
                                   <a href="#rowDireccion">Finalizar pedido</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row" id="rowDireccion">
                    <div class="col-lg-4 col-md-6">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Dirección de Entrega</h4>
                            </div>
                            <?php if (isset($direcciones)){?>
                                <div class="tax-wrapper">
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                Selecciona la dirección a donde te enviaríamos tu pedido
                                            </label>
                                            <?= $this->Form->input('direccion_id',array('type'=>'select','onchange'=>'javascript:seleccionarDireccion()','label'=>false,'empty'=>'Selecciona la dirección de entrega','class'=>'form-control','options'=>$direcciones))?>
											<br><div id="alertaDireccion"></div>
											<center><a href="#" class="btn btn-duki-resumen" data-toggle="modal" data-target="#modal_direcciones"><i class="fa fa-plus-circle" aria-hidden="true"  data-backdrop="static" data-keyboard="false"></i> Agrega una nueva dirección</a></center>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="tax-wrapper">
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                Selecciona la colonia a donde te enviaríamos tu pedido
                                            </label>
                                            <?= $this->Form->input('cp_id',array('type'=>'select','label'=>false,'empty'=>'Buscar tu Código Postal, Colonia o Municipio','class'=>'form-control','options'=>$cps,'required'=>true))?>
											<br><div id="alertaDireccion"></div>
											<center><a href="#" class="btn btn-duki-resumen" data-toggle="modal" data-target="#modal_direcciones"><i class="fa fa-plus-circle" aria-hidden="true"  data-backdrop="static" data-keyboard="false"></i> Agrega una nueva dirección</a></center>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Utilizar Cupón de Descuento</h4>
                            </div>
                            
                            <div class="discount-code">
                                <p>Introduce el cupón y da click en validar.</p>
                                <!-- AQUI ESTAN LAS LINEAS DEL FORMULARIO DEL CUPON -->
                                <form method="post" id="validaCupon">
                                  <div class="input text"><input name="data[Pedido][cupon]" maxlength="50" type="text" id="PedidoCupon"></div>
                                  <div id="alertaCupon"></div>
                                  <center><button class="cart-btn-2" type="submit">Aplicar Cupón</button></center>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Total</h4>
                            </div>
                            <h5>Total Productos <span id="total_productos"></span></h5>
                            <div class="total-shipping">
                                <h5>Cupón de descuento</h5>
                                <ul>
                                    <li>
                                        <div id="redLabel"></div>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                </ul>
                            </div> -->
                            <h4 class="grand-totall-title">Total <span id="gran_total"></span></h4>
                            <?= $this->Html->link('Finalizar Pedido',array('controller'=>'pedidos','action'=>'pagar'))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart area end -->
<?php echo $this->fetch('postLink'); ?>
<script>
var carrito_front = <?= json_encode($carrito)?>;
var pedido = "<?= $carrito['Pedido']['id']?>";
</script>
 <?= $this->Html->script('canasta.js'); ?>
