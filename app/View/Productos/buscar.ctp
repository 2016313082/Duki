
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1>Resultados para: <?= $searchstring?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- Shop Category Area End -->
<div class="shop-category-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Shop Top Area Start -->
                <div class="shop-top-bar">
                    <!-- Left Side start -->
                    <div class="shop-tab nav mb-res-sm-15">
                        <p>Mostrando <?= sizeof($productos)?> productos.</p>
                    </div>
                    <!-- Left Side End -->
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap">
                        <div class="shot-product">
                            <p>Ordenar por:</p>
                        </div>
                        <div class="shop-select">
                            <select  class="nice-select">
                                <option value="">A - Z</option>
                                <option value=""> Z - A</option>
                                <option value="">Por precio más bajo</option>
                                <option value="">Por precio más alto</option>
                            </select>
                        </div>
                    </div>
                    <!-- Right Side End -->
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area mt-35">
                    <!-- Shop Tab Content Start -->
                    <div class="tab-content jump">
                        <!-- Tab One Start -->
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                <?php foreach ($productos as $producto):?>
									<div class="col-xl-3 col-md-4 col-sm-6">
										<?= $this->Element('Productos/grid_view',array('producto'=>$producto['Producto'],'tipo'=>'busqueda','categoria_id'=>$producto['ProductosCategoria']['categoria_id']))?>
									</div>
								<?php endforeach?>
                            </div>
                        </div>
                        <!-- Tab One End -->
                    </div>
                    <!-- Shop Tab Content End -->                                
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Category Area End -->