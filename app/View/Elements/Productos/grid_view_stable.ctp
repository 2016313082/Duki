<?= $this->Form->create('Pedido',array('url'=>array('action'=>'addCarrito','controller'=>'pedidos')))?>
<article class="list-product">
    <div class="img-block">
        <a href="#" class="thumbnail">
            <?= $this->Html->image($producto['fotografia'],array('class'=>'first-img','alt'=>'DukiMX - '.$producto['nombre']))?>
        </a>
    </div>
    <div class="product-decs">
        <a class="inner-link" href="shop-4-column.html"><span>CALIDAD DUKI</span></a>
        <h2><?= $this->Html->link($producto['nombre'],array('controller'=>'productos','action'=>'view',$producto['id']),array('class'=>'product-link'))?></h2>
        <div class="pricing-meta">
            <ul>
                <li class="current-price">$<?= number_format($producto['precio_venta']*(1+($producto['tasa_iva']/100)),2)."/".$producto['unidad_principal']?></li>
            </ul>
        </div>
    </div>
    <div class="add-to-link" style="padding:2%">
        <div class="row">
            <div class="product-details-content" style="width:100%">
                <div class="pro-details-quality mt-0px">
                    <div class="col-xl-6 col-sm-12">
                        <div class="cart-plus-minus">
                            <?= $this->Form->input('cantidad',array('type'=>'text','class'=>'cart-plus-minus-box','value'=>1,'label'=>false))?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="dropdown-navs">
                            <ul>
                                <!-- Currency Start -->
                                <li class="top-10px first-child">
                                    <select class='nice-select' id="unidad" name="data[Pedido][unidad]">
                                        <option value="<?= $producto['unidad_principal']?>"><?= $producto['unidad_principal']?></option>
                                        <?php if ($producto['unidad_secundaria']!="") {?>
                                            <option value="<?= $producto['unidad_secundaria']?>"><?= $producto['unidad_secundaria']?></option>
                                        <?php }?>
                                    </select>
                                </li>
                                <!-- Currency End -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="input text" style="width: 100%;">
                <?= $this->Form->input('notas',array('type'=>'text','placeholder'=>'Notas Adicionales','div'=>false,'style'=>'width:100%;height: 50px;border: 1px solid silver;','label'=>false))?>
            </div>
        </div>
        <div class="row" style="margin-top: 5%;">
            <div style="width:100%">
                <div class="pro-details-cart btn-hover" >
                    <?= $this->Form->hidden('id',array('value'=>$producto['id'])) ?>
                    <?php 
                        if (isset($categoria['Categoria']['id'])){
                            echo $this->Form->hidden('categoria_id_return',array('value'=>$categoria['Categoria']['id']));
                        }
                        
                    ?>
                    <?php 
                        echo $this->Form->submit(
                            'Comprar',
                            array('style'=>'text-align:center;width:100%','class'=>'shop-btn animated','type'=>'submit'
                            )
                        )?>
                </div>
            </div>
        </div>      
    </div>
</article>
<?= $this->Form->end()?>