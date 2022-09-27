$(document).ready(function(){
	$('#unidad<?= $producto['id']?>').on('change',function(){
		alert('hola');
		if($('#unidad<?= $producto['id']?>').val() == 'Gr'){
			$('#cantidad<?= $producto['id']?>').attr('min',100);
			$('#cantidad<?= $producto['id']?>').attr('step',50);
			$('#cantidad<?= $producto['id']?>').val(100);
			$('#cantidad<?= $producto['id']?>').attr('min',100);
		}else{
			$('#cantidad<?= $producto['id']?>').removeAttr('min');
			$('#cantidad<?= $producto['id']?>').removeAttr('step');
			$('#cantidad<?= $producto['id']?>').val(1);
		}
		
	})
})

