<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="description" content="DUKI.MX es una tienda totalmente en línea"/>
	<meta name="robots" content="follow"/> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
	
    <link rel="apple-touch-icon" sizes="57x57" href="<?= Router::url('/img/favicon/apple-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= Router::url('/img/favicon/apple-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= Router::url('/img/favicon/apple-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= Router::url('/img/favicon/apple-icon-76x76.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= Router::url('/img/favicon/apple-icon-114x114.png')?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= Router::url('/img/favicon/apple-icon-120x120.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= Router::url('/img/favicon/apple-icon-144x144.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Router::url('/img/favicon/apple-icon-152x152.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Router::url('/img/favicon/apple-icon-180x180.png')?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= Router::url('/img/favicon/android-icon-192x192.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Router::url('/img/favicon/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= Router::url('/img/favicon/favicon-96x96.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Router::url('/img/favicon/favicon-16x16.png')?>">
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<style>
	html, body {
		min-height: 100%;
	}
	</style>
	<?php
		echo $this->Html->css(
			array(
				'plugins/bootstrap.min',
				//'plugins/font-awesome.min',
				'plugins/ionicons.min.css',
				'plugins/jquery-ui.min',
				'plugins/meanmenu', 
				'plugins/nice-select',
				'plugins/owl-carousel',
				'plugins/slick',
				'style',
				'responsive',
				'whatsap.css',
                '/vendors/chosen/css/chosen'
			)
		);
        echo $this->fetch('meta');
		echo $this->fetch('css');
        echo $this->Html->script(
            array(
                //'plugins/jquery.min',
                'vendor/jquery-3.5.1.min',
                '/vendors/chosen/js/chosen.jquery',
                'plugins/bootstrap.min',
                'plugins/popper.min',
                'plugins/meanmenu',
                'plugins/owl-carousel',
                'plugins/jquery.nice-select',
                'plugins/countdown',
                'plugins/elevateZoom',
                'plugins/jquery-ui.min',
                'plugins/slick',
                'plugins/scrollup',
                'plugins/range-script',
                'main',
                'vendor/modernizr-3.7.1.min', 
                '//cdn.jsdelivr.net/npm/sweetalert2@11',
                'bootstrap-input-spinner'
            )
        );

        echo $this->fetch('script');

        echo $this->fetch('script');
		if(date("N") == "3" || date("N") == "4"){
			$categorias = array(
				//123=>'Día del Padre',
				125=>'Promociones patrias',
				//99=>'Higiene Personal',
				104=>'Mercadito',
				88=>'Frutas',
				96=>'Carnes y Pescados',
				94=>'Despensa',
				//91=>'Consume Local',
				//103=>'Promociones'
			);
			
			$otros = array(
				101=>'Hogar y Limpieza',
				93=>'Granel',
				94=>'Despensa',
				89=>'Verduras',
				//104=>'Mercadito',
				93=>'Granel',
				91=>'Consume Local',
				//121=>'Alimentos Preparados',
				//110=>'Bebés y Niños',
				//98=>'Congelados',
				108=>'Dulces y botanas',
				//100=>'Farmacia',
				//107=>'Healthy',
				99=>'Higiene Personal, Belleza',
				//101=>'Hogar y Limpieza',
				95=>'Lácteos y Huevo',
				//102=>'Mascotas',
				//106=>'Panadería y Tortillería',
				//111=>'Recetas',
				//97=>'Salchichoneria',
				//109=>'Otras',
				90=>'Cervezas, Vinos y Licores',
				103=>'Promociones',
				109=>'Otras'
			); 
		}else{
			$categorias = array(
				125=>'Promociones patrias',
				//103=>'Promociones',
				//123=>'Día del Padre',
				//103=>'Promociones',
				//99=>'Higiene Personal',
				//103=>'Promociones',
				88=>'Frutas',
				89=>'Verduras',
				96=>'Carnes y Pescados',
				93=>'Granel',
				//94=>'Despensa'
				//91=>'Consume Local',
				
			);
			
			$otros = array(
				94=>'Despensa',
				99=>'Higiene Personal',
				91=>'Consume Local',
				103=>'Promociones',
				//121=>'Alimentos Preparados',
				//110=>'Bebés y Niños',
				//98=>'Congelados',
				108=>'Dulces y botanas',
				//100=>'Farmacia',
				//107=>'Healthy',
				//99=>'Higiene Personal',
				//101=>'Hogar y Limpieza',
				95=>'Lácteos y Huevo',
				//102=>'Mascotas',
				//106=>'Panadería y Tortillería',
				//111=>'Recetas',
				//97=>'Salchichoneria',
				90=>'Cervezas, Vinos y Licores',
				109=>'Otros'
			); 
		}

        

		
	?>
		<style>
			.btn-duki{
				background: #4fb68b;
				color: #FFFFFF;
			}
			
		</style>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-FWH8T4FVLY"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-FWH8T4FVLY');
		</script>
        <script>var base_url = "<?= Router::url('/', true); ?>"; </script>
		<script>var pedido_id = <?= json_encode($carrito['Pedido']['id']) ?>;</script>
</head>
<body>
			
		<a href="https://api.whatsapp.com/send?phone=524461393615&text=Hola%20%C2%BFComo%20te%20podemos%20ayudar?" class="float" target="_blank">
			<i class="fa fa-whatsapp my-float" ></i>
		</a>	
		<div class="duki_carga">
			<div class="spinner_duki"></div>
		</div>
        <!-- main layout start from here -->
        <!--====== PRELOADER PART START ======-->

        <!-- <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div> -->

        <!--====== PRELOADER PART ENDS ======-->
        <div id="main">
            <!-- Header Start -->
            <header class="main-header">
                <!-- Header Top Start -->
                <div class="header-top-nav">
                    <div class="container-fluid">
                        <div class="row">
                            <!--Right Start-->
							<div class="col-lg-6 col-6" style="color:white;">
							<a data-toggle="modal" data-target="#verifica_CP">
                                <div id="cps">	
									<?php 
										if(isset($_COOKIE['Codigo_postal'])) {
											$existecp = 1;
											$cp = " <i class='fa fa-map-marker' aria-hidden='true'></i> Enviar a: " . $_COOKIE['Codigo_postal'];
										}else{
											$existecp = 0;
											$cp = " <i class='fa fa-map-marker' aria-hidden='true'></i> Busca tu Codigo Postal";
										}

										if(isset($_COOKIE['Colonia'])){
											$colonia = $_COOKIE['Colonia'];
										}else{
											$colonia = '';
										}
									?>
									<script> var existecp = <?=$existecp?>;</script>
								</div>
							</div>
							</a>
                            <div class="col-lg-6 col-6" style="color:white;">
                                <div class="header-right-nav">
                                    <div class="dropdown-navs">
                                        <ul>
                                            <!-- Settings Start -->
                                            <li class="dropdown">
												<?php if($this->Session->read('Auth.User.nombres')!= null):
												$micuenta = $this->Session->read('Auth.User.nombres');
												?> 
												<a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= $micuenta ?></a>
													<ul class="dropdown-nav">
														<li><?= $this->Html->link('Mi Cuenta',array('controller'=>'users','action'=>'mi_cuenta'))?></li>
														<a href="<?= Router::url('/', true); ?>users/logout"><li><br><span style="color:black;">Salir</span><br><br></li></a>
													</ul>
												<?php else:
													$micuenta = "REGISTRARSE / INICIAR SESIÓN";
												?>
												<a href="<?= Router::url('/', true); ?>users/mi_cuenta"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= $micuenta ?></a>
												<?php endif;?>
                                            </li>
                                            <!-- Settings End -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Right End-->
                        </div>
                    </div>
                </div>
                <!-- Header Top End -->
                <!-- Header Buttom Start -->
                <div class="header-navigation sticky-nav">
                    <div class="container-fluid">
                        <div class="form-row">
                            <!-- Logo Start -->
                            <div class="col-sm-2 col-12">
                                <div class="logo">
                                    <?= $this->Html->link($this->Html->image('logo/logo.png',array('style'=>'height:45px')),array('controller'=>'pages','action'=>'home'),array('escape'=>false))?>
                                </div>
                            </div>
                            <!-- Logo End -->
                            <!-- Navigation Start -->
                            <div class="col-sm-10 col-12">
                                <!--Main Navigation Start -->
                                <div class="main-navigation d-none d-lg-block">
                                    <ul>
                                        <?php foreach($categorias as $llave => $categoria):?>
                                            <li><?= $this->Html->link($categoria,array('controller'=>'categorias','action'=>'view',$llave))?></li>
                                        <?php endforeach?>
                                        <li class="menu-dropdown">
                                            <a href="#">Ver Más <i class="ion-ios-arrow-down"></i></a>
                                            <ul class="sub-menu">
                                                <?php foreach($otros as $llave => $categoria):?>
                                                    <li><?= $this->Html->link($categoria,array('controller'=>'categorias','action'=>'view',$llave))?></li>
                                                <?php endforeach?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!--Main Navigation End -->
                                <!--Header Bottom Account Start -->
                                <div class="header_account_area">
                                    <!--Seach Area Start -->
                                    <div class="header_account_list search_list">
                                        <a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        <div class="dropdown_search">
                                            <?= $this->Form->create('Producto',array('url'=>array('controller'=>'productos','action'=>'buscar')))?>
                                                <?= $this->Form->input('searchstring',array('label'=>false,'type'=>'text','placeholder'=>'Buscar Producto en DUKI','required'=>'true'))?>
                                                
                                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <?= $this->Form->end()?>
                                        </div>
                                    </div>
                                    <!--Seach Area End -->
                                    <!--Contact info Start -->
                                    <!--<div class="contact-link">
                                        <div class="phone">
                                            <p>¡Contáctanos!:</p>
                                            <a href="phone:4421044822">442-104-4822</a>
                                        </div>
                                    </div>-->
                                    <!--Contact info End -->
                                    <!--Cart info Start -->
                                    <?php
                                        $useragent=$_SERVER['HTTP_USER_AGENT'];

                                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                                            $movil = "item-quantity-tag-sm";
                                        }else{
                                            $movil = 'hidden';
                                        }
                                    ?>
                                    <div class="<?= $movil ?>"> 
                                        <span class="item-quantity-tag item-quantity-tag-sm" id="q_pedido_span1"><?= isset($carrito['Productos'])?sizeof($carrito['Productos']):0?></span>
                                    </div>
                                    <div class="cart-info d-flex">
                                        <div class="mini-cart-warp">
                                            <a class="count-cart">
                                                <span id="total"></span>
                                                <span class="item-quantity-tag item-quantity-tag-sm" id="q_pedido_span"><?= isset($carrito['Productos'])?sizeof($carrito['Productos']):0?></span>
                                            </a>
                                            <div class="mini-cart-content scrollable-menu">
                                                <ul id="mini_carrito">
                                                <?php 
                                                    $total = 0;
                                                    foreach($carrito['Productos'] as $producto):
                                                ?>
                                                    <li class="single-shopping-cart" id=carritoRow<?= $producto['pedidos_productos']['id']?>>
                                                        <div class="shopping-cart-img">
                                                            <?= $this->Html->image($producto['fotografia'],array('style'=>'width:40px'))?>
                                                            <span class="product-quantity"><?= $producto['pedidos_productos']['cantidad_solicitada']?></span>
                                                        </div>
                                                        <div class="shopping-cart-title">
                                                            <h5 style="font-size:0.9em"><?= $producto['nombre']?></h5>
                                                            <span>$<?= number_format($producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'],2)?></span>
                                                            <div class="shopping-cart-delete">
                                                                <a href="javascript:deleteRowCarrito(<?= $producto['pedidos_productos']['id']?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php 
                                                    $total += $producto['pedidos_productos']['monto_solicitado']+$producto['pedidos_productos']['iva_solicitado']+$producto['pedidos_productos']['ieps_solicitado'];
                                                    endforeach; 
                                                ?>
                                                </ul>
                                                <div class="shopping-cart-total">
                                                    <h4>Subtotal : <span id="subtotal_carrito">$<?= number_format($total,2)?></span></h4>
                                                    <script>
                                                        document.getElementById('total').innerHTML = new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(<?= $total?>);
                                                    </script>
                                                </div>
                                                <div class="shopping-cart-btn text-center">
                                                    <?= $this->Html->link('Ver Canasta',array('controller'=>'pedidos','action'=>'resumen'),array('class'=>'default-btn'))?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
									
                                    <script>
                                        function deleteRowCarrito(id){
                                            if(id){
                                                var dataString = 'id='+ id;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo Router::url(array('controller' => 'pedidos', 'action' => 'removeCarritoRow'), TRUE); ?>" ,
                                                    data: dataString,
                                                    cache: false,
                                                    success: function(html) {
                                                        if(html.respuesta == 1){
															mini_canasta(); 
                                                        }
                                                    }
                                                });
                                            }
                                        }

                                        function addCarrito(id){
											//var tipo_cards = document.getElementById('tipo_cards').value;
                                            var cantidad = document.getElementById('cantidad'+id).value;
                                            var unidad = document.getElementById('unidad'+id).value;
                                            var notas = document.getElementById('notas'+id).value;
                                            var updateProducto = '';
											var iva_carrito = 0;
											var ieps_carrito = 0;
											var monto_carrito = 0;
                                            $.ajax({
                                                'url' : base_url + 'pedidos/validaCarrito',
                                                'datatype' : 'json',
                                                'success' : function(obj){
												
                                                    if(obj.isLogged){
                                                        if(id){  
                                                            $.ajax({
                                                                'url': base_url + 'pedidos/addCarrito' ,
                                                                'type' : 'post',
                                                                'data': {'id' : id,
                                                                       'cantidad' : cantidad,
                                                                       'unidad':unidad,
                                                                       'notas':notas},
                                                                'datatype':'json',
                                                                'success': function(html) {
                                                                    console.log(html);
                                                                    if(html.existencia == true){
																		let updateProducto = [id,pedido_id];
                                                                        edit_product2(updateProducto);
                                                                    }else{
                                                                        mini_canasta();
																		$('#label_added'+id).removeClass('d-none'); 
                                                                    } 
                                                                } 
                                                            });
                                                        }
                                                    }else{
                                                        $('#resultado_cp').html('');
                                                        $('#resultado_cp').prepend('<option>No hay resultados</option>');
                                                        $('#img_cp').attr('src', base_url + 'img/logo/logo.png');
                                                        $('#modal_fraccionamiento').modal('show'); 
                                                    }
                                                }
                                            });
                                        }

                                    </script>
                                    <!--Cart info End -->
                                </div>
                            </div>
                        </div>
                        <!-- mobile menu -->
                        <div class="mobile-menu-area">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <?php foreach($categorias as $llave => $categoria):?>
                                            <li><?= $this->Html->link($categoria,array('controller'=>'categorias','action'=>'view',$llave))?></li>
                                        <?php endforeach?>
										<?php foreach($otros as $llave => $categoria):?>
                                            <li><?= $this->Html->link($categoria,array('controller'=>'categorias','action'=>'view',$llave))?></li>
                                        <?php endforeach?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- mobile menu end-->
                    </div>
                </div>
                <!--Header Bottom Account End -->
            </header>
            <!-- Header End -->

			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>

            <!-- Footer Area start -->
            <footer class="footer-area">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-4">
                                <!-- footer logo -->
                                <div class="footer-logo">
                                    <?= $this->Html->link($this->Html->image('logo/logo.png',array('style'=>'height:45px')),array('controller'=>'pages','action'=>'home'),array('escape'=>false))?>
                                </div>
                                <!-- footer logo -->
                                <div class="about-footer">
                                    <p class="text-info">Haz tu súper con nosotros, descurbre deliciosos productos locales y vive la experiencia DUKI</p>
                                    <div class="need-help">
                                        <p class="phone-info">
                                            ¿Necesitas ayuda? Contáctanos por WhatsApp
                                            <span>
                                                446-139-3615
                                            </span>
                                        </p>
                                    </div>
                                    <div style="margin-top:50px">
                                        <p>
                                            <h4 class="footer-herading">CONTACTO</h4>
                                            <p style="margin-top:10px"><span><a href="mailto:hola@duki.mx" style="color:black"><i class="fa fa-envelope"></i> hola@duki.mx</span></a></p>
											<p><a href="tel:4461393615" style="color:black"><span><i class="fa fa-phone"></i>446-139-3615</span></a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-2 mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">DUKI.MX</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <li><?= $this->Html->link('Entregas',array('controller'=>'pages','action'=>'entregas'))?></li>
                                            <li><?= $this->Html->link('Cambios, Devoluciones y Cancelaciones',array('controller'=>'pages','action'=>'cambios'))?></li>
                                            <li><?= $this->Html->link('Nosotros',array('controller'=>'pages','action'=>'nosotros'))?></li>
                                            <li><?= $this->Html->link('Formas de Pago',array('controller'=>'pages','action'=>'formas_pago'))?></li>
                                            <li><?= $this->Html->link('Términos y Condiciones',array('controller'=>'pages','action'=>'terminos'))?></li>
                                            <li><?= $this->Html->link('Aviso de Privacidad',array('controller'=>'pages','action'=>'privacidad'))?></li>
                                            <li><?= $this->Html->link('Preguntas Frecuentes',array('controller'=>'pages','action'=>'faq'))?></li>
                                            <li><?= $this->Html->link('Mi cuenta',array('controller'=>'users','action'=>'mi_cuenta'))?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-2 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Categorías</h4>
                                    <div class="footer-links">
                                        <ul>
                                            <?php foreach($categorias as $llave => $categoria):?>
                                                <li><?= $this->Html->link($categoria,array('controller'=>'categorias','action'=>'view',$llave))?></li>
                                            <?php endforeach?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                            <div class="col-md-6 col-lg-4 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                                <div class="single-wedge">
                                    <h4 class="footer-herading">Newsletter</h4>
                                    <div class="subscrib-text">
                                        <p>Inscríbete a la comunidad DUKI para recibir noticias, recetas y promociones exclusivas</p>
                                    </div>
                                    <div id="mc_embed_signup" class="subscribe-form">
                                        <?= $this->Form->create('Newsletter',array('url'=>array('action'=>'add','controller'=>'newsletters')))?>
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <?= $this->Form->input('correo_electronico',array('type'=>'email','required'=>'required','class'=>'email','placeholder'=>'Ingresa tu correo electróinico','label'=>false))?>
                                                <div class="clear">
                                                    <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Suscribirse" />
                                                </div>
                                            </div>
                                        <?= $this->Form->end()?>
                                    </div>
                                    <h4 class="footer-herading" style="margin-top:25px">Síguenos</h4>
                                    <div class="img_app">
                                        <?= $this->Html->link($this->Html->image('logo/facebook.png',array('height'=>'40px','style'=>'width:40px')),'https://www.facebook.com/duki.mxmx',array('target'=>'__blank','escape'=>false))?>
                                        <?= $this->Html->link($this->Html->image('logo/instagram.png',array('height'=>'40px','style'=>'width:40px')),'https://www.instagram.com/duki.mx/',array('target'=>'__blank','escape'=>false))?>
                                        <?= $this->Html->link($this->Html->image('logo/tiktok.png',array('height'=>'40px','style'=>'width:40px')),'https://www.tiktok.com/@duki.mx?',array('target'=>'__blank','escape'=>false))?>
                                    </div>
                                </div>
                            </div>
                            <!-- footer single wedget -->
                        </div>
                    </div>
                </div>
                <!--  Footer Bottom Area start -->
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <p class="copy-text">Todos los derechos reservados © <a href="https://www.duki.mx">DUKI.MX</a>.</p>
                            </div>
                            <div class="col-md-6 col-lg-8">
                                <table style="width:20%">
                                    <tr>
                                        <td><?= $this->Html->image('logo/amex.png',array('width'=>'40px','height'=>'auto'))?></td>
                                        <td><?= $this->Html->image('logo/mc.png',array('width'=>'40px','height'=>'auto'))?></td>
                                        <td><?= $this->Html->image('logo/visa.png',array('width'=>'40px','height'=>'auto'))?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Footer Bottom Area End-->
            </footer>
            <!--  Footer Area End -->
        </div>
		<!-- Modal editar producto de carrito -->
<div class="modal fade" id="editar_producto_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edita productos de tu canasta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form method="post" id="form-update-pedido2">
			<input id="id_carrito1" name="data[PedidosProducto][id]" hidden> 
			<div class="form-row">
				<div class="col-sm-6 col-12">
					<img id="img-producto1" style="width:300px">
				</div>
				<div class="col-sm-6 col-12">
					<div class="form-row">
						<div class="col-sm-12 col-12">
							<div id="alerta-existencias1"></div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6 col-12">
							<label for="cantidad">Cantidad</label>
							<input type="number" id="cantidad1" name="data[PedidosProducto][cantidad_solicitada]"> 
						</div>
						<div class="col-sm-6 col-12">
							<label for="unidad">Unidad</label>
							<select class="form-control" id="unidad_select" name="data[PedidosProducto][unidad_solicitada]">
				
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6 col-12">
							<h5>Nombre del producto</h5>
						</div>
						<div class="col-sm-6 col-12">
							<span id="producto1"></span>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6 col-12">
							<h4>Subtotal</h4>
						</div>
						<div class="col-sm-6 col-12">
							<input class="form-control" id="subtotal1" readonly>
						</div>
						<input id="ieps1" name="data[PedidosProducto][ieps_solicitado]" hidden>
						<input id="iva1" name="data[PedidosProducto][iva_solicitado]" hidden>
						<input id="subtotal2" name="data[PedidosProducto][monto_solicitado]" hidden>
					</div>
				</div>
			</div>
		</form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="form-update-pedido2" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal direccion -->
		<div class="modal fade" id="modal_fraccionamiento" tabindex="-1" role="dialog" aria-labelledby="modal_fraccionamiento" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-row">
						<div class="col-sm-12 col-12">
							<center><img id="img_cp" style="height:60px;"></center>
						</div>
						<div class="col-sm-12 col-12" style="margin-top: 2%;">
							<div class="card">
								<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inicio de sesión</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Crear cuenta</a>
									</li>
								</ul>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<form id="form-login">
											<div class="col-sm-12 col-12">
												<span>Correo</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Correo" type="mail" name="data[User][email]">
											</div>
											<div class="col-sm-12 col-12">
												<span>Contraseña</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Contraseña" type="password" name="data[User][password]" id="pLog">
											</div><br>
											<div class="col-sm-12 col-12" >
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="verPassLog">
													<label class="custom-control-label" for="verPassLog"><h5 id="eyeLog"></h5></label> 
												</div>
											</div>
											<div class="col-sm-12 col-12" style="margin-top: 2%;">
												<center><button class="btn btn-duki btn-block">Enviar</button></center>
											</div><br>
										</form>
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										<form id="form-registro">
											<div class="col-sm-12 col-12">
												<span>Correo</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Correo" type="mail" name="email" id="email">
											</div>
											<div class="col-sm-12 col-12">
												<span>Nombres</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Nombres" type="text" id="nombres" name="nombres">
											</div>
											<div class="col-sm-12 col-12">
												<span>Apellido paterno</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Apellido paterno" type="text" id="apPaterno" name="apellido_paterno">
											</div>
											<div class="col-sm-12 col-12">
												<span>Celular</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Celular" type="number" id="celular" name="celular">
											</div>
											<div class="col-sm-12 col-12">
												<span>Contraseña</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Contraseña" type="password" id="p1" name="password">
											</div>
											<div class="col-sm-12 col-12">
												<span>Confirmar contraseña</span>
											</div>
											<div class="col-sm-12 col-12" >
												<input class="form-control" placeholder="Confirmar contraseña" type="password" id="p2">
											</div><br>
											<div class="col-sm-12 col-12">
												<?= $this->Form->input("tyc",array('required'=>true,'style'=>'height: 15px;width: 15px;','label'=>array('text'=>'Acepto los '.$this->Html->link('términos y condiciones',array('controller'=>'pages','action'=>'terminos'),array('target'=>'_blank')),'style'=>"margin-left:5px"),'type'=>"checkbox",'id'=>'tyc'))?>
											</div>
											<div class="col-sm-12 col-12">
												<div id="validador"></div>
											</div>
											<div class="col-sm-12 col-12">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="verPass">
													<label class="custom-control-label" for="verPass"><h5 id="eye"></h5></label> 
												</div>
											</div>
											<div class="col-sm-12 col-12" >
												<center><button class="btn btn-duki btn-block">Enviar</button></center>
											</div><br>
										</form>
									</div>
								</div>
							</div>	
						</div>
						<!--<div class="col-sm-6 col-12" style="margin-top: 2%;">
							<div class="col-sm-12 col-12">
								<h5>Verifica si tu zona cuenta con disponibilidad</h5><br>
							</div>
							<div class="col-sm-12 col-12">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Código postal, colonia o fraccionamiento" aria-label="Código postal" aria-describedby="basic-addon2" id="buscador_cp">
									<div class="input-group-append">
										<button class="btn btn-outline-secondary" type="button"><span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span></button>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-12">
								<select class="form-control" id="resultado_cp" size="3"></select>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			</div>
		</div>
		
		<div class="modal fade" id="verifica_CP" tabindex="-1" role="dialog"  >
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">	
					<div class="col-sm-12">
						<center><img src="https://static.wixstatic.com/media/ffd21c_75c0edb51b9d4518a08835e76fd3bea7~mv2.png/v1/crop/x_271,y_397,w_4984,h_4207/fill/w_291,h_245,al_c,usm_0.66_1.00_0.01,enc_auto/DUKI_LOGOS_FINALES-05.png" alt="DUKI_LOGOS_FINALES-05.png" style="width:110px;height:90px;object-fit:cover;object-position:50% 50%"></center>
					</div>				
						<br>	
						<div class="col-sm-12">
							<div class="col-sm-12">
								<h5>Verifica si tu zona cuenta con disponibilidad</h5><br>
							</div>

							<form id="CodigoPostal" name="CodigoPostal" >
							<div class="col-sm-12">
								<div class="input-group mb-3">
									<input type="number" class="form-control" maxlength="5" min="0" placeholder="Código postal" aria-label="Código postal" aria-describedby="basic-addon2" id="buscador_cp">
										<div class="input-group-append">
										<button class="btn btn-outline-secondary" type="submit"><span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span></button>
									</div>
								</div>
							</div>
							</form>
							<div class="col-sm-12 col-12 ">
								<div id="listaCp" name="listaCp"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modal-terminos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Términos y condiciones</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<h5><ol>
					<li><b>Promoción mezcal Brije</b><br>
					En la compra de una botella de mezcal Brije, llévate la segunda botella con un 15% de descuento.</li> <br>

					<li><b>Promoción en tu six de cervezas</b><br>
					Selecciona 6 cervezas de la misma marca y aplica tu 30% de descuento.</li><br>

					<li><b>Promocion bandera</b><br>
					Obtén hasta un 50% de descuento en productos seleccionados de frutas, verduras, granel, carnes y pescados.</li><br>
				</ol></h5>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="modal_direcciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registrar dirección</h5>
				</div>
				<div class="modal-body">
						<form id="direcciones">
							<div class="row">
								<div class="col-sm-12 col-12">
									<label for="nombre">Nombre de la dirección</label>
									<input class="form-control" placeholder="Ingresa el alias de la dirección" id="nombre_direccion" name="data[Direccion][nombre]">
								</div>
								<div class="col-sm-4 col-6">
									<label for="calle">Calle</label>
									<input class="form-control" placeholder="Ingresa la calle de la direccion" id="calle" name="data[Direccion][calle]">
								</div>
								<div class="col-sm-4 col-6">
									<label for="calle">Número exterior</label>
									<input class="form-control" placeholder="Ingresa el número exterior" id="numero_exterior" name="data[Direccion][numero_exterior]">
								</div>
								<div class="col-sm-4 col-12">
									<label for="calle">Número interior</label>
									<input class="form-control" placeholder="Ingresa el número interior" id="numero_interior" name=data[Direccion][numero_interior]>
								</div>
								<div class="col-sm-12 col-12">
									<label for="calle">Privada</label>
									<input class="form-control" placeholder="Privada (en caso de requerirlo)" id="privada" name="data[Direccion][privada]">
								</div>
								<div class="col-sm-12 col-12">
									<br><h5>Verifica si tu zona cuenta con disponibilidad</h5>
								</div>
								<div class="col-sm-12 col-12">
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Código postal, colonia o fraccionamiento" aria-label="Código postal" aria-describedby="basic-addon2" id="buscador_cp_1">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="button"><span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span></button>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-12">
									<select class="form-control" id="resultado_cp_1" size="3" name="data[Direccion][cp_id]">
										<option selected disabled>Selecciona una opcion</option>
									</select>
								</div>
								<div class="col-sm-12 col-12">
									<div id="alerta_direcciones"></div>
								</div>
								<div class="col-sm-12 col-12">
									<br><button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
	
<script>
var contenido = '';
var cp ="<?= $cp ?>";
var colonia_cookie ="<?= $colonia ?>";
$(document).ready(function(){

	if(existecp == 0){
		$('#verifica_CP').modal({backdrop: 'static', keyboard: false});
		$('#cps').html(cp +' '+colonia_cookie);


	}else{
		$('#verifica_CP').modal('hide');
		$('#cps').html(cp +' '+colonia_cookie);

	}

	var eye = '<i class="fa fa-eye-slash" aria-hidden="true">';
	$('#eye').html(eye);
	var eyeLog = '<i class="fa fa-eye-slash" aria-hidden="true">';
	$('#eyeLog').html(eyeLog);

	$('#verPass').click(function () {
		if ($('#verPass').is(':checked')) {
			$('#eye').html('');
			$('#p1').attr('type', 'text');
			$('#p2').attr('type', 'text');
			eye = '<i class="fa fa-eye" aria-hidden="true"></i>';
		} else {
			$('#eye').html('');
			$('#p1').attr('type', 'password');
			$('#p2').attr('type', 'password');
			eye = '<i class="fa fa-eye-slash" aria-hidden="true">';
		}
		$('#eye').html(eye);
	});
	
	$('#verPassLog').click(function(){
		if ($('#verPassLog').is(':checked')) {
			$('#eyeLog').html('');
			$('#pLog').attr('type', 'text');
			eyeLog = '<i class="fa fa-eye" aria-hidden="true"></i>';
		} else {
			$('#eyeLog').html('');
			$('#pLog').attr('type', 'password');
			eyeLog = '<i class="fa fa-eye-slash" aria-hidden="true">';
		}
		$('#eyeLog').html(eyeLog);
	});
	
	$('#form-login').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'users/login_portable',
			'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
            'success': function(obj){
				if(obj.resultado == true){
					$('#modal_fraccionamiento').modal('hide');
					swal.fire({
						'icon' : 'success',
						'title' : 'Se ha iniciado sesíon',
						'allowOutsideClick': false, 
					}).then((result) => {			
						if (result.isConfirmed) {
							location.reload();
						}
					})
				}else{
					$('#modal_fraccionamiento').modal('hide');
					swal.fire({
						'icon' : 'error',
						'title' : obj.mensaje,
					})
				}
			}	
		});
	});
	
	$('#form-registro').on('submit',function(e){
		e.preventDefault();
		var cadena = /[^a-zA-Z0-9]/;
		var cadenaNum = /^[0-9]+$/;
		$('#validador').html('');
		nombre = document.getElementById('nombres').value;
		apPaterno = document.getElementById('apPaterno').value;
		celular = document.getElementById('celular').value;
		password = document.getElementById('p1').value;
		password_2 = document.getElementById('p2').value;
		
		if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
            alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El correo introducido no es correcto</div>';
			$('#validador').html(alerta);
            return false;
        }else if(nombre.length < 3 || nombre.length > 20){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El nombre debe de ser mayor de 2 caracteres y menor a 20</div>';
			$('#validador').html(alerta);
			return false;
		}else if(apPaterno.length < 3 || apPaterno.length > 20){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El apellido paterno debe de ser mayor de 2 caracteres y menor a 20</div>';
			$('#validador').html(alerta);
			return false;
		}else if(celular.length != 10){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>El numero de celular debe ser de 10 digitos</div>';
			$('#validador').html(alerta);
			return false;
		}else if(password.length < 8){ 
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>La contraseña debe de ser mayor a 8 digitos</div>';
			$('#validador').html(alerta);
			return false;
		}else if(cadena.test(password) == false){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>La contraseña debe de tener mínimo un caracter especial</div>';
			$('#validador').html(alerta);
			return false;
		}else if(password != password_2){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>Las contraseñas no coinciden</div>';
			$('#validador').html(alerta);
			return false;
		}else if(!document.getElementById('tyc').checked){
			alerta = '<div class="alert alert-danger" role="alert"><b>Error: </b>Debes aceptar terminos y condiciones</div>';
			$('#validador').html(alerta);
			return false;
		}

		$.ajax({
			'url' : base_url + 'users/crear_cuenta_portable',
			'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
            'success': function(obj){
				console.log(obj);
				if(obj.resultado == true){
					$('#modal_fraccionamiento').modal('hide');
					swal.fire({
						'icon' : 'success',
						'title' : 'Se ha registrado exitosamente',
						'allowOutsideClick': false,
					}).then((result) => {			
						if (result.isConfirmed) {
							location.reload();
						}
					})
				}else{
					
					$('#modal_fraccionamiento').modal('hide');
					swal.fire({
						'icon' : 'error',
						'title' : obj.mensaje,
						'allowOutsideClick': false,
					})
				}
			}
		});
	});
	
	$('#direcciones').on('submit',function(e){
		e.preventDefault();
		var nombre_direccion = $('#nombre_direccion').val();
		var calle = $('#calle').val();
		var numero_exterior = $('#numero_exterior').val();
		var privada = $('#privada').val();
		var cp = $('#resultado_cp_1').val();
		if(nombre_direccion.length < 3){
			alerta_direcciones = '<div class="alert alert-danger"><strong>Error: </strong>El nombre debe de ser mayor a 3 letras</div>';
			$('#alerta_direcciones').html(alerta_direcciones);
			return false;
		}else if(calle.length <= 0){
			alerta_direcciones = '<div class="alert alert-danger"><strong>Error: </strong>La calle no debe estar vacía</div>';
			$('#alerta_direcciones').html(alerta_direcciones);
			return false;
		}else if(numero_exterior.length <= 0){
			alerta_direcciones = '<div class="alert alert-danger"><strong>Error: </strong>El número exterior no debe estar vacío</div>';
			$('#alerta_direcciones').html(alerta_direcciones);
			return false;
		}else if(cp == null){
			alerta_direcciones = '<div class="alert alert-danger"><strong>Error: </strong>Selecciona código postal</div>';
			$('#alerta_direcciones').html(alerta_direcciones);
			return false;
		}

		$.ajax({
			'url' : base_url + 'direccions/registrar_direccion',
			'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
			'success' : function(obj){
				console.log(obj);
				if(obj.resultado == true){
					$('#modal_direcciones').modal('hide');
					swal.fire({
						'icon' : 'success',
						'title' : 'Se ha registrado tu dirección',
					}).then((result) => {			
						if (result.isConfirmed) {
							location.reload();
						}
					})
				}else{
					$('#modal_direcciones').modal('hide');
					swal.fire({
						'icon' : 'error',
						'title' : obj.mensaje,
					})
				}
			}
		});
	});
	
	/*$('#buscador_cp , #buscador_cp_1').keyup(function(){
	   $('#resultado_cp , #resultado_cp_1').html('');
	   if($('#buscador_cp_1').val() != ''){
			var buscador_cp = $('#buscador_cp_1').val();
	   }else if($('#buscador_cp').val() != ''){
			var buscador_cp = $('#buscador_cp').val();
	   }

	   var resultado_cp = '';
	   var contador = 0;
	   var colonia = '';
	   var separador = ' ';
	   var textoSeparado = '';
	   var cadena = '';
	   $.ajax({
		   'url' : base_url + 'cps/traer_cps',
		   'data' : {'buscador_cp':buscador_cp},
		   'type' : 'post',
		   'datatype' : 'json',
		   'success' : function(obj){
			   if(obj.Cps_contar[0][0].num_result == 0){
				   resultado_cp += '<option>No se encontraron resultados</option>';
			   }else{
				   $.each(obj.Cps, function (i, elemento){
						resultado_cp += '<option value="'+elemento.cps.id+'">'+elemento.cps.cp+', '+elemento.cps.colonia+', '+elemento.cps.municipio+'</option>';
					})
			   }
			   $('#resultado_cp,#resultado_cp_1').prepend(resultado_cp);
		   }
	   });
    });*/
	
	$('#CodigoPostal').on('submit', function(e){
		e.preventDefault();
			var buscador_cp = $('#buscador_cp').val();
			var resultado_cp = '';
			var contador = 0;
			var colonia = '';
			var separador = ' ';
			var textoSeparado = '';
			var cadena = '';
			$.ajax({
				'url' : base_url + 'cps/traer_cps',
				'data' : {'buscador_cp':buscador_cp},
				'type' : 'post',
				'datatype' : 'json',
				'success' : function(obj){
					//console.log(obj);
					if(obj.resultado == false){
						swal.fire({
								'imageUrl': "https://static.wixstatic.com/media/ffd21c_75c0edb51b9d4518a08835e76fd3bea7~mv2.png/v1/crop/x_271,y_397,w_4984,h_4207/fill/w_291,h_245,al_c,usm_0.66_1.00_0.01,enc_auto/DUKI_LOGOS_FINALES-05.png",
								'title':'Aun no contamos con disponibilidad en esa zona. Pronto estaremos en tu zona',
								imageWidth: 180,
  								imageHeight: 160
							})
							$('#verifica_CP').modal('hide');
					}else{
						$.each(obj.Cps, function (i, elemento){
								resultado_cp += "<a onclick='enviar_colonia("+elemento.cps.id+")'>"+elemento.cps.cp+", "+elemento.cps.colonia+", "+elemento.cps.municipio+"</a><br><hr>";
							})	
											

					}
					$('#listaCp').html(resultado_cp);

				}
           });
    });
        
	mini_canasta();
    datos();
	$('.duki_carga').addClass('d-none');
	
	$('#form-update-pedido2').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'pedidos/updateProducto',
			'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
            'success': function(obj){
				if(obj.resultado == true){
					swal.fire({
						'icon' : 'success',
						'title' : 'El producto se actualizó correctamente en tu canasta',
					})
					$('#tabla-carrito').html("");
					$('#editar_producto_2').modal('hide');
					datos();
					mini_canasta();
					//recargar_datos();
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'No se pudo actualizar el producto',
					})
				}
			}
		})
	})
})

function enviar_colonia(id){
	var resultado = $('#resultado_cp').val();
	$('#cps').html('');

	$.ajax({
		'url' : base_url + 'cps/cookies',
		'data' : {'resultado_cp':id},
		'type' : 'post',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj['resultado']);

			if(obj['resultado']==true){
				$('#verifica_CP').modal('hide');
				$('#cps').html("<i class='fa fa-map-marker' aria-hidden='true'></i> "+obj[0]['cps']['cp']+' '+obj[0]['cps']['colonia']);
			}
		}
	})
}

function datos(){
    var total = 0;
    var contador = 0;
	var iva = 0;
	var ieps = 0;
	var monto = 0;
    $.ajax({
        'url' : base_url + 'pedidos/recargar_datos',
        'datatype' : 'json',
        'success' : function(obj){
            $('#total').text('');
            $('#q_pedido_span').text('');
            $.each(obj.Productos,function(i,elemento){
				monto = Number(elemento.pedidos_productos.monto_solicitado);
				iva = Number(elemento.pedidos_productos.iva_solicitado)
				ieps = Number(elemento.pedidos_productos.ieps_solicitado)
				if(elemento.unidad_secundaria != ''){
					total += Number(elemento.pedidos_productos.monto_solicitado); 
				}else{
					total += monto+iva+ieps; 
				}
                contador ++;
            })
			var decimales = dinero(total,false,1);
			console.log(decimales); 
			console.log(decimales);
            $('#total').text('$'+decimales+0); 
            $('#q_pedido_span').text(contador);
			$('#q_pedido_span1').text(contador);
			$('#subtotal_carrito').text('$'+decimales+0);
        }
    }) 
}  

function objeto_edit(id,pedido_id){
	let updateProducto = [id,pedido_id];
    edit_product2(updateProducto);
}

function inicio_sesion(){
    $('#form-login').removeClass('d-none');
	$('#form-registro').addClass('d-none');
}

function registro(){
    $('#form-login').addClass('d-none');
	$('#form-registro').removeClass('d-none');
}

function edit_product2(updateProducto){
	var producto_id = updateProducto[0];
    var ped_id = updateProducto[1];
	$('#cantidad1').unbind(); 
	$('#cantidad1').inputSpinner('destroy');
	$('#editar_producto_2').modal('show');
	$('#unidad_select').html('');
	$('#img-producto1').html('');
	$('#cantidad1').val(0);
	$('#subtotal1').val(0);
	$('#producto1').text('');
	$('#alerta-existencias1').html('');
	var options = ""; 
	var conversion = 0;
	var contador = 0;
	var nuevo_total = 0;
	var cantidad = 0;
	var bandera = 0;
	var conversion_precio = 0;
	var conversion_peso = 0;
	$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
	$.ajax({
		'url' : base_url + 'pedidos/traer_producto_2',
		'type' : 'post',
		'data' : {
                'id_producto': producto_id,
                'id_pedido': ped_id
            },
		'datatype' : 'json',
		'success' : function(obj){
			$('#id_carrito1').val(obj.PedidosProducto.id);
			$('#img-producto1').attr('src',base_url+obj.Producto.fotografia);
			//quitar precio unitario
			if(obj.ProductosCategoria.categoria_id == 88 || obj.ProductosCategoria.categoria_id == 112){
				$('#cantidad1').attr('min',0.5);
				$('#cantidad1').attr('step',0.5);
				$('#cantidad1').attr('data-decimals',1);
			}
			$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
			$('#subtotal1').val((Number(obj.PedidosProducto.monto_solicitado) + Number(obj.PedidosProducto.iva_solicitado) + Number	(obj.PedidosProducto.ieps_solicitado)).toFixed(2));
			$('#producto1').text(obj.Producto.nombre);
			if(obj.Producto.tasa_iva == 16){
				$('#ieps1').val(0);
				$('#iva1').val((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta);
				$('#subtotal2').val(obj.Producto.precio_venta);
			}else if(obj.Producto.tasa_ieps == 8){
				$('#ieps1').val((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta);
				$('#iva1').val(0);
				$('#subtotal2').val(obj.Producto.precio_venta);
			}else{
				$('#ieps1').val(0);
				$('#iva1').val(0);
				$('#subtotal2').val(Number(obj.PedidosProducto.monto_solicitado));
			}
			$('#alerta-existencias1').html('');
			options += "<option disabled>Selecciona una unidad</option>";
			switch(obj.PedidosProducto.unidad_solicitada){ 
					case 'Pieza':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad1').inputSpinner('destroy');
						$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad1').html('');
						$('#cantidad1').removeAttr('min');
						$('#cantidad1').attr('min',1);
						$('#cantidad1').removeAttr('step');
						$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						if(obj.Producto.inventario < 1){
							options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else{
							if(obj.Producto.unidad_secundaria == ''){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
								console.log('hola 1');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
								options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 2');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 3');
							}
						}
							
						conversion_peso = obj.Producto.conversion;
					break;
					
					case 'Kg': 
						if(obj.ProductosCategoria.categoria_id == 88 || obj.ProductosCategoria.categoria_id == 112){
							conversion_precio = obj.Producto.precio_venta;
							console.log(conversion_precio);
							$('#cantidad1').inputSpinner('destroy');
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').attr('min',0.5);
							$('#cantidad1').attr('step',0.5);
							$('#cantidad1').attr('data-decimals',1);
							$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = 1;
						}else{
							conversion_precio = obj.Producto.precio_venta;
							$('#cantidad1').inputSpinner('destroy');
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').removeAttr('min');
							$('#cantidad1').attr('min',1);
							$('#cantidad1').removeAttr('step');
							$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = 1;
						}
					break;
					
					case 'Gr':
						if(obj.ProductosCategoria.categoria_id == 96){
							console.log(obj.PedidosProducto.unidad_solicitada);
							conversion = obj.Producto.precio_venta * obj.Producto.conversion;
							console.log(conversion_precio);
							$('#cantidad1').html('');
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').attr('min',500);
							$('#cantidad1').attr('step',500);
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = obj.Producto.conversion;
						}else{
							console.log(obj.PedidosProducto.unidad_solicitada);
							conversion = obj.Producto.precio_venta * obj.Producto.conversion;
							console.log(conversion_precio);
							$('#cantidad1').html('');
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').attr('min',100);
							$('#cantidad1').attr('step',50);
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = obj.Producto.conversion;
						}
							
					break;
					
					case 'Manojo':
					console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta;
						console.log(conversion_precio);
						$('#cantidad1').inputSpinner('destroy');
						$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad1').html('');
						$('#cantidad1').removeAttr('min');
						$('#cantidad1').attr('min',1);
						$('#cantidad1').removeAttr('step');
						$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						if(obj.Producto.inventario < 1){
							options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else{
							if(obj.Producto.unidad_secundaria == ''){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
								console.log('hola 1');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
								options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 2');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 3');
							}
						}
						conversion_peso = obj.Producto.conversion;
					break;
			} 
			$('#cantidad1').unbind();
			$('#cantidad1').on('input', function (event) {
					cantidad = $('#cantidad1').val() * conversion_peso; 
					console.log(cantidad);
					nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					if(parseFloat(cantidad) > parseFloat(obj.Producto.inventario)){
						bandera = 1;
						$('#cantidad1').val(obj.Producto.inventario * conversion_peso);
						nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						console.log(nuevo_total);
					}else{
						bandera = 0;
						$('#alerta-existencias1').html('');
						nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					}
					
					if(bandera == 1){
						alerta_existencias = '<div class="alert alert-danger" role="alert">La cantidad solicitada excede los productos de inventario</div>';
						$('#alerta-existencias1').html(alerta_existencias);
						bandera = 0;
					}
					contador = contador + parseFloat(cantidad);
					$('#subtotal1').val(dinero(nuevo_total,false,1));
					if(obj.Producto.tasa_iva == 16){
						$('#ieps1').val(0);
						$('#iva1').val(nuevo_total*0.16);
						$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
					}else if(obj.Producto.tasa_ieps == 8){  
						$('#ieps1').val(nuevo_total*0.08);
						$('#iva1').val(0);
						$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
					}else{
						$('#ieps1').val(0);
						$('#iva1').val(0);
						$('#subtotal2').val(nuevo_total);
					}
			});
			
			$('#unidad_select').prepend(options);
			$('#unidad_select').unbind();
			$('#unidad_select').on('change',function(){
				$('#subtotal1').val(0);
				var valor = 0;
				var cantidad = 0;
				var iva_solicitado = 0;
				var ieps_solicitado = 0;
				nuevo_total = 0;
				var unidad = $('#unidad_select').val();
				switch(unidad){ 
					case 'Pieza':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad1').inputSpinner('destroy');
						$('#cantidad1').val(1);
						$('#cantidad1').removeAttr('min');
						$('#cantidad1').attr('min',1);
						$('#cantidad1').removeAttr('step');
						$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						if(obj.Producto.inventario < 1){
							options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else{
							if(obj.Producto.unidad_secundaria == ''){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
								console.log('hola 1');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
								options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 2');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 3');
							}
						}
						conversion_peso = obj.Producto.conversion;
						nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(obj.Producto.tasa_iva == 16){
							$('#ieps1').val(0);
							$('#iva1').val(nuevo_total*0.16);
							$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
						}else if(obj.Producto.tasa_ieps == 8){  
						$('#ieps1').val(nuevo_total*0.08);
						$('#iva1').val(0);
						$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
						}else{
							$('#ieps1').val(0);
							$('#iva1').val(0);
							$('#subtotal2').val(nuevo_total);
						}
					break;
					
					case 'Kg': 
						console.log(unidad);
						conversion_precio = obj.Producto.precio_venta;
						console.log(conversion_precio);
						$('#cantidad1').inputSpinner('destroy');
						$('#cantidad1').val(1);
						$('#cantidad1').removeAttr('min');
						$('#cantidad1').attr('min',1);
						$('#cantidad1').removeAttr('step');
						$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						if(obj.Producto.inventario < 1){
							options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else{
							if(obj.Producto.unidad_secundaria == ''){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
								console.log('hola 1');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
								options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 2');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 3');
							}
						}
						conversion_peso = 1;
						nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*Number(obj.Producto.precio_venta)) + Number((obj.Producto.tasa_ieps/100)*Number(obj.Producto.precio_venta)));
						if(obj.Producto.tasa_iva == 16){ 
							$('#ieps1').val(0);
							$('#iva1').val(nuevo_total*0.16);
							$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
						}else if(obj.Producto.tasa_ieps == 8){  
							$('#ieps1').val(nuevo_total*0.08);
							$('#iva1').val(0);
							$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
						}else{
							$('#ieps1').val(0);
							$('#iva1').val(0);
							$('#subtotal2').val(nuevo_total);
						}
					break;
					
					case 'Gr':
						if(obj.ProductosCategoria.categoria_id == 96){
							console.log(unidad);
							conversion = obj.Producto.precio_venta * obj.Producto.conversion;
							console.log(conversion_precio);
							$('#cantidad1').inputSpinner('destroy');
							$('#cantidad1').val(500);
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').attr('min',500);
							$('#cantidad1').attr('step',500);
							$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = obj.Producto.conversion;
							nuevo_total = $('#cantidad1').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
							if(obj.Producto.tasa_iva == 16){
								$('#ieps1').val(0);
								$('#iva1').val(nuevo_total*0.16);
								$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
							}else if(obj.Producto.tasa_ieps == 8){  
								$('#ieps1').val(nuevo_total*0.08);
								$('#iva1').val(0);
								$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
							}else{
								$('#ieps1').val(0);
								$('#iva1').val(0);
								$('#subtotal2').val(nuevo_total);
							}
						}else{
							console.log(unidad);
							conversion = obj.Producto.precio_venta * obj.Producto.conversion;
							console.log(conversion_precio);
							$('#cantidad1').inputSpinner('destroy');
							$('#cantidad1').val(100);
							$('#cantidad1').val(obj.PedidosProducto.cantidad_solicitada);
							$('#cantidad1').attr('min',100);
							$('#cantidad1').attr('step',50);
							$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
							if(obj.Producto.inventario < 1){
								options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
							}else{
								if(obj.Producto.unidad_secundaria == ''){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
									console.log('hola 1');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
									options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 2');
								}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
									options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
									"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
									console.log('hola 3');
								}
							}
							conversion_peso = obj.Producto.conversion;
							nuevo_total = $('#cantidad1').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
							if(obj.Producto.tasa_iva == 16){
								$('#ieps1').val(0);
								$('#iva1').val(nuevo_total*0.16);
								$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
							}else if(obj.Producto.tasa_ieps == 8){  
								$('#ieps1').val(nuevo_total*0.08);
								$('#iva1').val(0);
								$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
							}else{
								$('#ieps1').val(0);
								$('#iva1').val(0);
								$('#subtotal2').val(nuevo_total);
							}
						}
							
					break;
					
					case 'Manojo':
						$('#cantidad1').inputSpinner('destroy');
						$('#cantidad1').val(1);
						$('#cantidad1').removeAttr('min');
						$('#cantidad1').attr('min',1);
						$('#cantidad1').removeAttr('step');
						$('#cantidad1').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						console.log(unidad);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						if(obj.Producto.inventario < 1){
							options += "<option readonly selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else{
							if(obj.Producto.unidad_secundaria == ''){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
								console.log('hola 1');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
								options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 2');
							}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
								options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
								"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
								console.log('hola 3');
							}
						}
						conversion_peso = obj.Producto.conversion;
						nuevo_total = $('#cantidad1').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					break;
				} 
				
				$('#cantidad1').unbind();
				$('#cantidad1').on('input', function (event) {
						cantidad = $('#cantidad1').val() * conversion_peso; 
						console.log(cantidad);
						nuevo_total = ($('#cantidad1').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(parseFloat(cantidad) >= parseFloat(obj.Producto.inventario)){
							bandera = 1;
							$('#cantidad1').val(obj.Producto.inventario * conversion_peso);
							nuevo_total = $('#cantidad1').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
							console.log(nuevo_total);
						}else{
							bandera = 0;
							$('#alerta-existencias1').html('');
							nuevo_total = $('#cantidad1').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						}
						
						if(bandera == 1){
							alerta_existencias = '<div class="alert alert-danger" role="alert">La cantidad solicitada excede los productos de inventario</div>';
							$('#alerta-existencias1').html(alerta_existencias);
							bandera = 0;
						} 
						contador = contador + parseFloat(cantidad);
						$('#subtotal1').val(dinero(nuevo_total,false,1)); 
						contador = contador + parseFloat(cantidad);
				$('#subtotal1').val(dinero(nuevo_total,false,1));
				if(obj.Producto.tasa_iva == 16){
					$('#ieps1').val(0);
					$('#iva1').val(nuevo_total*0.16);
					$('#subtotal2').val(nuevo_total - (nuevo_total*0.16));
				}else if(obj.Producto.tasa_ieps == 8){  
					$('#ieps1').val(nuevo_total*0.08);
					$('#iva1').val(0);
					$('#subtotal2').val(nuevo_total - (nuevo_total*0.08));
				}else{
					$('#ieps1').val(0);
					$('#iva1').val(0);
					$('#subtotal2').val(nuevo_total);
				}
				});
				
				$('#subtotal1').val(dinero(nuevo_total,false,1));
				datos(); 
			}); 	
		}
	})
}

function round(value, decimals){
	return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

function dinero(n, simbolo, decimals){
	var c = isNaN(decimals) ? 2 : Math.abs(decimals),
		d = '.',
		t = ',', 
		simbolo = (simbolo == false) ? "" : "$ ", 
		sign = (n < 0) ? '-' : '',
		i = parseInt(n = Math.abs(n).toFixed(c)) + '',
		j = ((j = i.length) > 3) ? j % 3 : 0;

	return simbolo + sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
}

function recargar_datos(){ 
	$('#tabla-carrito').html('');
    $.ajax({
        'url' : base_url + 'pedidos/recargar_datos',
        'datatype' : 'json',
        'success' : function(obj){
			console.log(obj.Pedido.id);
			//console.log(carrito_front.Productos);
			var total = 0;
			var Tcont = "";
			var subtotal = 0;
			var img = "";
			$.each(obj.Productos, function(i,elemento){
				unidad = '<span>'+elemento.pedidos_productos.cantidad_solicitada+'</span>' +'/'+'<span>'+elemento.pedidos_productos.unidad_solicitada+'</span>';
				img = elemento.fotografia;
				subtotal = Number(elemento.pedidos_productos.monto_solicitado) + Number(elemento.pedidos_productos.iva_solicitado) + Number(elemento.pedidos_productos.ieps_solicitado);
				Tcont += 
				'<tr>' +
				'<td class="product-name">' + '<img src="'+img+'" style="width:100px" alt="">' + '</td>' +
				'<td class="product-name">' + elemento.nombre + '</td>' +
				'<td class="product-name">' + unidad + '</td>' +
				'<td class="product-subtotal">' + dinero(subtotal,false,1) + '</td>' +
				'<td class="product-name">' + '<button class="btn btn-info" onclick="objeto_edit('+elemento.pedidos_productos.producto_id+','+elemento.pedidos_productos.pedido_id+')"><i class="far fa-edit"></i></button>' +
				'<button class="btn btn-danger" onclick="delete_product('+elemento.pedidos_productos.id+')"><i class="fa fa-trash"></i></button>' +
				'</td>' +

				'</tr>';
				total = total + Number(subtotal);
			});
			$('#tabla-carrito').append(Tcont);
			$('#total_productos').text('$' + Number(total).toFixed(2));
			$('#gran_total').text('$' + Number(total).toFixed(2));
			$('#redLabel').text('Sin cupón');
        }
    })
}

function mini_canasta(){
	var row = "";
	var total = 0;
	var q_total = 0;
	var iva_carrito = 0;
	var ieps_carrito = 0;
	var monto_carrito = 0;
	$.ajax({
        'url' : base_url + 'pedidos/recargar_datos',
        'datatype' : 'json',
        'success' : function(obj){
			console.log(obj);
			document.getElementById('mini_carrito').innerHTML = "";
			$.each(obj.Productos,function(i,elemento){
				iva_carrito = Number(elemento.pedidos_productos.iva_solicitado);
				ieps_carrito = Number(elemento.pedidos_productos.ieps_solicitado);
				monto_carrito = Number(elemento.pedidos_productos.monto_solicitado);
				if(elemento.unidad_secundaria != ''){
					total += Number(monto_carrito.toFixed(2));
				}else{
					total += Number(monto_carrito.toFixed(2))+Number(iva_carrito.toFixed(2))+Number(ieps_carrito.toFixed(2));
				} 
				q_total++;
				row = row+"<li class='single-shopping-cart' id='carritoRow"+elemento.id+"'><div class='shopping-cart-img'><img src='" + base_url +elemento.fotografia+"' style='width:50px'><span class='product-quantity'>"+elemento.pedidos_productos.cantidad_solicitada+"</span></div><div class='shopping-cart-title'><h4 style='font-size:1em'>"+elemento.nombre+"</h4><span>"+new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(dinero(monto_carrito+iva_carrito+ieps_carrito,false,1))+"</span><a href='javascript:objeto_edit("+elemento.id+","+obj.Pedido.id+")'><i class='fa fa-pencil-square-o fa-2x' aria-hidden=true'></i></a><a href='javascript:deleteRowCarrito("+elemento.pedidos_productos.id+")'><i class='fa fa-trash fa-2x' style='color:red;'></i></a></div></li>"; 
				//row = row+"<li class='form-row' id='carritoRow"+elemento.id+"'><div class='col-4'><img src='/duki_pruebas"+elemento.fotografia+"' style='width:50px'><span class='product-quantity'>"+elemento.pedidos_productos.cantidad_solicitada+"</span></div><div class='col-8'><h4 style='font-size:1em'>"+elemento.nombre+"</h4><span>"+new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(dinero(monto_carrito+iva_carrito+ieps_carrito,false,1))+"</span><a href='javascript:objeto_edit("+elemento.id+","+obj.Pedido.id+")'><i class='far fa-edit fa-2x'></i></a><a href='javascript:deleteRowCarrito("+elemento.pedidos_productos.id+")'><i class='fa fa-trash fa-2x' style='color:red;'></i></a></div></li>";
				//row = row+"<li class='single-shopping-cart form-row' id='carritoRow"+elemento.id+"'><div class='shopping-cart-img col-2'><img src='/duki_pruebas"+elemento.fotografia+"' style='width:50px'><span class='product-quantity'>"+elemento.pedidos_productos.cantidad_solicitada+"</span></div><div class='form-row'><div class='col-12'><center><h5 style='font-size:1em'>"+elemento.nombre+"</h5></center></div><div class='col-2'><span>"+new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(dinero(monto_carrito+iva_carrito+ieps_carrito,false,1))+"</span></div><div class='col-2'><a href='javascript:objeto_edit("+elemento.id+","+obj.Pedido.id+")'><i class='far fa-edit'></i></a><a href='javascript:deleteRowCarrito("+elemento.pedidos_productos.id+")'><i class='fa fa-trash' style='color:red;'></i></a></div></li>";
			}); 
			console.log('total canasta1' + dinero(total,false,1));	
			document.getElementById('mini_carrito').innerHTML = row;
			document.getElementById('total').innerHTML = "";
			document.getElementById('total').innerHTML = new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(dinero(total,false,1));
			document.getElementById('q_pedido_span').innerHTML = "";
			document.getElementById('q_pedido_span').innerHTML = q_total;
			document.getElementById('q_pedido_span1').innerHTML = "";
			document.getElementById('q_pedido_span1').innerHTML = q_total;
			document.getElementById('subtotal_carrito').innerHTML = "";
			document.getElementById('subtotal_carrito').innerHTML = new Intl.NumberFormat("es-MX", {style: "currency", currency: "MXN"}).format(dinero(total,false,1));
			//document.getElementById('label_added'+id).style.display="";
			datos(); 
			recargar_datos();
		}
	});
	
}

function unidad1(unidad_principal,id,inventario,categoria){
	$('#cantidad'+id).inputSpinner('destroy');
	$('#cantidad'+id).removeAttr('step');
	if(categoria == 88 || categoria == 89 || categoria == 96){
		$('#cantidad'+id).attr('step',0.5);
		$('#cantidad'+id).attr('data-decimals',1);
	}
	$('#cantidad'+id).attr('min',1);
	$('#cantidad'+id).attr('max',inventario);
	$('#cantidad'+id).attr('data-prefix',unidad_principal);
	$('#cantidad'+id).val(1);
	$('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
	$('#unidad'+id).val(unidad_principal);
}

    function unidad2(categoria,unidad_secundaria,id,inventario,conversion,categoria_2){
	console.log(categoria_2);
        var inventario_gramos = inventario*1000;
        if(unidad_secundaria == 'Gr'){
            if(categoria == 96 || categoria == 104 && categoria_2 == 96){
                $('#cantidad'+id).inputSpinner('destroy');
                $('#cantidad'+id).attr('min',500);
                $('#cantidad'+id).attr('max',inventario_gramos);
                $('#cantidad'+id).attr('step',500);
                $('#cantidad'+id).removeAttr('data-decimals');
                $('#cantidad'+id).attr('data-prefix',unidad_secundaria);
                $('#cantidad'+id).val(500);
                $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
                $('#unidad'+id).val(unidad_secundaria);
                //conversion = 0.180;
            }else{
                $('#cantidad'+id).inputSpinner('destroy');
                $('#cantidad'+id).attr('min',100);
                $('#cantidad'+id).attr('step',50);
                $('#cantidad'+id).removeAttr('data-decimals');
                $('#cantidad'+id).attr('max',inventario_gramos);
                $('#cantidad'+id).attr('data-prefix',unidad_secundaria);
                $('#cantidad'+id).val(100);
                $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
                $('#unidad'+id).val(unidad_secundaria);
                //conversion = 0.180;
            }	
        }else{
            var limite_pieza = inventario/conversion; //limite de inventario dependiendo de la conversion de la pieza
            $('#cantidad'+id).inputSpinner('destroy');
            $('#cantidad'+id).removeAttr('min');
            $('#cantidad'+id).removeAttr('step');
            $('#cantidad'+id).attr('min',1);
            $('#cantidad'+id).attr('data-prefix',unidad_secundaria); 
			$('#cantidad'+id).attr('max',limite_pieza);
            $('#cantidad'+id).val(1);
            $('#cantidad'+id).inputSpinner({buttonsOnly: true, autoInterval: undefined});
            $('#unidad'+id).val(unidad_secundaria); 
            //conversion = 0.180;
        }
    }
</script>