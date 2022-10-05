<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    $movil = "widht:100%; height:auto; height:125px";
	$owl = "";
}else{
    $movil = '';
	$owl = "owl-dot-style";
}
?>	
<div class="container">
	<div class="slider-area">
		<div class="slider-active-3 owl-carousel slider-hm8 <?= $owl?>">
			<!-- Slider Single Item Start -->
			
				<?php foreach($banners as $banner):?>
                    <a href="<?= $banner['Banner']['liga']?>">
                        <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img" style="background-image: url(<?= Router::url($banner['Banner']['imagen'])?>); <?= $movil ?>">
                            <div class="container">
                                <div class="slider-content-1 slider-animated-1 text-left">
                                    <span class="animated label-movil-sm"><?= $banner['Banner']['titulo1']?></span>
                                    <h1 class="animated label-movil">
                                        <?= $banner['Banner']['titulo2']?>
                                    </h1>
                                    <p class="animated"><?= $banner['Banner']['texto1']?></p>
                                </div>
                            </div>
                        </div>
                    </a>
				<?php endforeach;?>
			
			<!-- Slider Single Item End -->
		</div>
	</div>
</div>
<!-- Slider Arae End -->
<!-- Static Area Start -->
<section class="static-area mtb-40px mt-res-md-60px mt-res-lg-30px">
    <div class="container">
        <div class="static-area-wrap" style="padding: 0px 30px">
            <div class="row">
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-4 col-md-4 col-sm-12">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0">
                        <?= $this->Html->image('icons/icono-envio.png',array('class'=>'img-responsive'))?>
                        <div class="single-static-meta">
                            <h4>Tus productos favoritos</h4>
                            <p>Hasta la puerta de tu hogar</p> 
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <div class="col-lg-1 col-sx-1 col-md-1">
                    <hr align="left" class="lineaVertical" width="2px" noshade="noshade">
                </div>
                <!-- Static Single Item Start -->
                <div class="col-lg-4 col-xs-4 col-md-4 col-sm-12">
                    <div class="single-static pb-res-md-0 pb-res-sm-0">
                        <?= $this->Html->image('icons/icono-cobertura.png',array('class'=>'img-responsive'))?>
                        <div class="single-static-meta">
                            <h4>Entregas express</h4>
                            <p>En menos de 40 minutos</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <div class="col-lg-1 col-sx-1 col-md-1">
                    <hr align="left" class="lineaVertical" width="2px" noshade="noshade">
                </div>
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-4 col-md-4 col-sm-12">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0">
                        <?= $this->Html->image('icons/icono-pago.png',array('class'=>'img-responsive'))?>
                        <div class="single-static-meta">
                            <h4>Pagos 100% Seguros</h4>
                            <p>Aceptamos todas las tarjetas y pagos contra entrega</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Static Area End -->
<!-- Best Sells Area Start -->
<section class="best-sells-area mb-30px">
    <div class="container">
        <!-- Section Title Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title" >
                    <h2>Las frutas más frescas</h2>
                    <p>Especialmente para ti</p>
                </div>
            </div>
        </div>
        <!-- Section Title End -->
        <!-- Best Sell Slider Carousel Start -->
        <div class="best-sell-slider owl-carousel owl-nav-style" data-nosnippet>
            <!-- Single Item -->
            <?php foreach($semana as $producto):?>
                <?= $this->Element('Productos/grid_view',array('producto'=>$producto['productos'],'tipo'=>'despensa','categoria_id'=>$semana[0]['productos_categorias']['categoria_id']))?>
            <?php endforeach?>
            <!-- Single Item -->
        </div>
        <!-- Best Sells Carousel End -->
    </div>
</section>
<!-- Best Sells Slider End -->

<!-- Category Area Start -->
<section class="categorie-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title mt-res-sx-30px mt-res-md-30px">
                    <h2>Compra por categoria</h2>
                    <p>Tus productos favoritos hasta la puerta de tu hogar</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Category Slider Start -->
        <div class="category-slider owl-carousel owl-nav-style">
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                        <?= $this->Html->link($this->Html->image('duki/categorias/Frutas_Verduras.png'),array('controller'=>'categorias','action'=>'view',88),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px"> 
                    <div class="category-thumb">
                         <?= $this->Html->link($this->Html->image('duki/categorias/Carnes_Pescados.png'),array('controller'=>'categorias','action'=>'view',96),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                    <?= $this->Html->link($this->Html->image('duki/categorias/Lacteos_Huevo.png'),array('controller'=>'categorias','action'=>'view',95),array('escape'=>false))?>                        
                    </div>                    
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                        <?= $this->Html->link($this->Html->image('duki/categorias/Vinos_Licores.png'),array('controller'=>'categorias','action'=>'view',90),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                    <?= $this->Html->link($this->Html->image('duki/categorias/Limpieza_Hogar.png'),array('controller'=>'categorias','action'=>'view',101),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                    <?= $this->Html->link($this->Html->image('duki/categorias/Higiene_Personal.png'),array('controller'=>'categorias','action'=>'view',99),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                    <?= $this->Html->link($this->Html->image('duki/categorias/Promociones.png'),array('controller'=>'categorias','action'=>'view',103),array('escape'=>false))?>
                    </div>
                </div>
            </div>
            <div class="category-item">
                <div class="category-list mb-30px">
                    <div class="category-thumb">
                    <?= $this->Html->link($this->Html->image('duki/categorias/Consume_Local.png'),array('controller'=>'categorias','action'=>'view',91),array('escape'=>false))?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category Area End  -->
<!-- Hot deal area Start -->
<section class="hot-deal-area">
    <div class="container">
        <div class="row">
            
            <!-- New Arrivals Area Start -->
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-12">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title ml-0px mt-res-sx-30px">
                            <h2>Promociones</h2>
                            <p>Promociones frescas de hoy</p>
                        </div>
                        <!-- Section Title -->
                    </div>
                </div>
                
                <!-- New Product Slider Start -->
                <div class="new-product-slider owl-carousel owl-nav-style">
                    <?php $i=2?>
                    <?php foreach($mercado as $producto):?>
                        <?php if($i%2 == 0){
                            echo "<div class='product-inner-item'>";
                        } 
                        ?>
                            <?= $this->Element('Productos/grid_view',array('producto'=>$producto['productos'],'tipo'=>'nuevos','categoria_id'=>$mercado[0]['productos_categorias']['categoria_id']))?>
                            <?php if($i%2 != 0){
                                   echo "</div>";
                                } 
                            ?>
                        <?php $i++?>
                    <?php endforeach?>
                    <!-- Product Single Item -->
                </div>
        </div>
    </div>
</section>
<!-- Hot Deal Area End -->
<!-- Banner Area Start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="banner-wrapper">
                    <?= $this->Html->link($this->Html->image('banners/Emprendedores01.png'),array('controller'=>'categorias','action'=>'view',121),array('escape'=>false))?>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 mt-res-sx-30px">
                <div class="banner-wrapper">
                    <?= $this->Html->link($this->Html->image('banners/A2_Central.png'),array('controller'=>'categorias','action'=>'view',88),array('escape'=>false))?>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 mt-res-sx-30px">
                <div class="banner-wrapper">
                    <?= $this->Html->link($this->Html->image('banners/A3_Granel.png'),array('controller'=>'categorias','action'=>'view',93),array('escape'=>false))?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area End -->
<!-- Best Sells Area Start -->
<section class="best-sells-area mb-30px">
    <div class="container">
        <!-- Section Title Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Productos Destacados</h2>
                    <p>Lo que nuestros clientes prefieren.</p>
                </div>
            </div>
        </div>
        <!-- Section Title End -->
        <!-- Best Sell Slider Carousel Start -->
        <div class="best-sell-slider owl-carousel owl-nav-style">
            <!-- Single Item -->
            <?php foreach($destacados as $producto):?> 
                <?= $this->Element('Productos/grid_view',array('producto'=>$producto['productos'],'tipo'=>'destacados','categoria_id'=>$destacados[0]['productos_categorias']['categoria_id']))?>
            <?php endforeach?>
            <!-- Single Item -->
        </div>
        <!-- Best Sells Carousel End -->
    </div>
</section>
<!-- Best Sells Slider End -->
<!-- Banner Area 2 Start -->
<div class="banner-area-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-inner">
                    <a href="shop-4-column.html"><img src="assets/images/banner-image/4.jpg" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area 2 End -->

<script>
    function addCart(id){
        alert(id);
    }
</script>
