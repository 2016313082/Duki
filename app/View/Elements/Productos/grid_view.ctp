<?php $nuevo_id = $producto['id'].'_'.$tipo;?>
<article class="list-product">
    <div class="img-block">
        <?= $this->Html->image($producto['fotografia'],array('class'=>'first-img','alt'=>'DukiMX - '.$producto['nombre']))?>
    </div>
    <div class="product-decs">
        <span  style = "color: red; "><?= $producto['etiqueta']?></span> 
        <h2 class="product-link">
            <?= $producto['nombre']?>
        </h2>
        <div class="pricing-meta">
            <ul>
                <li class="current-price">$<?= number_format($producto['precio_venta']*(1+($producto['tasa_iva']/100)+($producto['tasa_ieps']/100)),2)."/".$producto['unidad_principal']?></li>
            </ul>
        </div>
    </div>
    <div class="add-to-link" style="padding:2%">
        <div class="row">
            <div class="product-details-content" style="width:100%">
                <div class="form-row">
                    <?php if($producto['inventario'] < 1 && $producto['unidad_secundaria'] == 'Gr'){
                            $inventario_gramos = $producto['inventario'] * 1000;
                    ?>
					<?php if($categoria_id == 96){?>
						<div class="col-sm-12 col-12">
                            <?= $this->Form->input('cantidad'.$producto['id'],array('type'=>'number','class'=>'form-control-sm','value'=>500,'min'=>500,'max'=>$inventario_gramos,'step'=>500,'label'=>false,'data-prefix'=>'Gr'))?>
                        </div>
					<?php }else{ ?>
						<div class="col-sm-12 col-12">
                            <?= $this->Form->input('cantidad'.$producto['id'],array('type'=>'number','class'=>'form-control-sm','value'=>100,'min'=>50,'max'=>$inventario_gramos,'step'=>50,'label'=>false,'data-prefix'=>'Gr'))?>
                        </div>
					<?php } ?>
            
                    <?php }else if($producto['inventario'] < 1 && $producto['unidad_secundaria'] == 'Pieza'){
                        $limite_pieza = $producto['inventario']/$producto['conversion'];
                    ?>
                        <div class="col-sm-12 col-12">
                            <?= $this->Form->input('cantidad'.$producto['id'],array('type'=>'number','class'=>'form-control-sm','value'=>1,'min'=>1,'max'=>$limite_pieza,'label'=>false,'data-prefix'=>'Pza'))?>
                        </div>
                    <?php }else{?>
                        <div class="col-sm-12 col-12">
                            <?= $this->Form->input('cantidad'.$producto['id'],array('type'=>'number','class'=>'form-control-sm','value'=>1,'min'=>1,'max'=>$producto['inventario'],'label'=>false,'data-prefix'=>$producto['unidad_principal']))?>
                        </div>
                    <?php }?>
                    <?php if($producto['unidad_secundaria']==""){?>
                        <input id="unidad<?= $producto['id']?>" value="<?= $producto['unidad_principal'] ?>" hidden>
                        <div class="col-sm-12 col-12">
                            <button class="form-control" style="margin-top: 2%;" disabled><?= $producto['unidad_principal']?></button>
                        </div>
                    <?php }else if($producto['inventario'] >= 1){?>
                        <input id="unidad<?= $producto['id']?>" value="<?= $producto['unidad_principal'] ?>" hidden>
                        <div class="col-sm-6 col-6">
                            <button class="form-control" style="margin-top: 2%;" id="unidad1<?= $producto['id']?>" onclick="unidad1('<?= $producto['unidad_principal']?>',<?= $producto['id']?>,<?= $producto['inventario']?>,<?= $categoria_id ?>);"><?= $producto['unidad_principal']?></button>
                        </div>
                        <div class="col-sm-6 col-6">
                            <button class="form-control" style="margin-top: 2%;" id="unidad2<?= $producto['id']?>" onclick="unidad2( <?= $categoria_id ?>,'<?= $producto['unidad_secundaria']?>',<?= $producto['id']?>,<?= $producto['inventario']?>,<?= $producto['conversion']?>);"><?= $producto['unidad_secundaria']?></button>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-12 col-12">
                            <input id="unidad<?= $producto['id']?>" value="<?= $producto['unidad_secundaria'] ?>" hidden>
                            <button class="form-control" disabled style="margin-top: 2%;" id="unidad2<?= $producto['id']?>"><?= $producto['unidad_secundaria']?></button>
                        </div>
                    <?php }?>
                    
                </div>
            </div>
        </div>
            <?php if($categoria_id == 88 || $categoria_id == 89){?>
                <?= $this->Form->input('notas'.$producto['id'],array('type'=>'text','placeholder'=>'Notas Adicionales','div'=>false,'style'=>'width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;','label'=>false))?>
			<?php }else if($categoria_id == 103){?>
				<?= $this->Form->hidden('notas'.$producto['id'],array('type'=>'text','placeholder'=>'Notas Adicionales','value'=>'2x1','div'=>false,'style'=>'width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;','label'=>false))?>
            <?php }else{?>
                <?= $this->Form->hidden('notas'.$producto['id'],array('type'=>'text','placeholder'=>'Notas Adicionales','div'=>false,'style'=>'width:100%;height: 50px;border: 1px solid silver; margin-top: 2%;','label'=>false))?>
            <?php }?>
        <div class="row" style="margin-top: 5%;">
            <div style="width:100%">
                <div class="added d-none" id="label_added<?= $producto['id']?>">
                    PRODUCTO AGREGADO A CARRITO
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 3%;">
            <div style="width:100%">
                <div class="pro-details-cart btn-hover" >
                    <?= $this->Form->hidden('id'.$producto['id'],array('value'=>$producto['id'])) ?>
                    <?php
                        echo $this->Html->link('Comprar','javascript:addCarrito('.$producto['id'].')',array('class'=>'shop-btn animated','style'=>'text-align:center;width:100%')) 
                    ?>
                </div>
            </div>
        </div> 
        <script>
            $('#cantidad<?= $producto['id']?>').inputSpinner({buttonsOnly: true, autoInterval: undefined});  
        </script>          
</article>
