<div style="width:100%">
    <div class="logo">
        <?= $this->Html->link($this->Html->image('logo/logo.png',array('style'=>'height:45px')),array('controller'=>'pages','action'=>'home'),array('escape'=>false))?>
    </div>
    <div class="datos_entrega">
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
        Correo Electrónico: <?= $pedido['Pedido']['email_contacto']?>
    </div>
    <?php
        if ($pedido['Pedido']['status']==5){
            if($pedido['Pedido']['forma_pago']==1){
                echo $this->Form->create('Pedido');
                echo $this->Form->hidden('id',array('value'=>$pedido['Pedido']['id']));
                echo $this->Form->input('pagado',array('type'=>'number','step'=>0.01,'min'=>0,'label'=>'Monto Pagado'));?>
                <br>
                <select name="data[Pedido][forma_pago]">
                    <option value="1" selected>Pago en efectivo a la entrega</option>
                    <option value="2">Pago en tarjeta a la entrega</option>
                </select><br><br>
                <?php
                echo $this->Form->input('comentario',array('label'=>'Comentarios'));
                echo $this->Form->submit('Registrar Pago y entrega',array('class'=>'btn btn-submit'));
                echo $this->Form->end();
            }else{
                echo $this->Form->create('Pedido',array('url'=>array('controller'=>'pedidos','action' => 'updateStatus')));
                echo $this->Form->hidden('pedido_id',array('value'=>$pedido['Pedido']['id']));
                echo $this->Form->hidden('status',array('value'=>6));
                echo $this->Form->input('comentario',array('label'=>'Comentarios'));?>
                 <br>
                <select name="data[Pedido][forma_pago]">
                    <option value="1">Pago en efectivo a la entrega</option>
                    <option value="2" selected>Pago en tarjeta a la entrega</option>
                </select><br><br>
                <?php
                echo $this->Form->submit('Marcar Pedido como entregado',array('style'=>'color:green','confirm'=>'¿Deseas confirmar este pedido como entregado?'));
                echo $this->Form->end();
            }
        }else{
            echo "Este pedido no puede cerrarse.";
        } 
        
    ?>
</div>