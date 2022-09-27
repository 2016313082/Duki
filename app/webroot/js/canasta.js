$(document).ready(function(){
	//$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
    carrito();
    $('#validaCupon').on('submit',function(e){
       e.preventDefault();
        var alerta = "";
        $('#alertaCupon').html('');
        $.ajax({
            'url' : base_url + 'pedidos/validarCupon',
            'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype': 'json',
            'success': function(obj){
                if(obj.validaCupon1 == false){
                    alerta += 
                    '<div class="alert alert-danger" role="alert">' +
                    obj.mensaje1 +
                    '</div>';
                    $('#alertaCupon').html(alerta); 
                }else{
                    if(obj.validaCupon2 == true){
                        alerta += 
                        '<div class="alert alert-success" role="alert">' +
                        obj.mensaje +
                        '</div>';
                        $('#alertaCupon').html(alerta);
						var total1 = $('#total').text().replace('$','');
						var total2 = total1.replace(',','');
                        descuento(total2);
                    }else{
                        alerta += 
                        '<div class="alert alert-danger" role="alert">' +
                        obj.mensaje +
                        '</div>';
                        $('#alertaCupon').html(alerta);
                    }
                }
            }
        })
    })

	$('#form-update-pedido').on('submit',function(e){
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
					$('#editar_producto').modal('hide');
					datos();
					recargar_datos();
					mini_canasta();
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

function seleccionarDireccion(){
        var alertaDireccion = "";
        $('#alertaDireccion').html('');
        var direccion = document.getElementById('direccion_id').value;
        if (direccion) {
        var dataString = 'direccion_id='+ direccion +"&pedido_id="+pedido;
        console.log(dataString);
        $.ajax({
            type: "POST",
            url: base_url + 'pedidos/setDireccion',
            data: dataString,
            cache: false,
            'success' : function(obj){
                if(obj == true){
                    alertaDireccion += 
                            '<div class="alert alert-success" role="alert">La direccion se agregó correctamente</div>';
                    $('#alertaDireccion').html(alertaDireccion);
                }else{
                    alertaDireccion += 
                            '<div class="alert alert-error" role="alert">La direccion no se pudo agregar</div>';
                    $('#alertaDireccion').html(alertaDireccion);
                }
            }
        });
    }
}

function descuento(total){
    $.ajax({
        'url' : base_url + 'pedidos/resumenDetalle',
        'datatype' : 'json',
        'success' : function(obj){
            var descuento = 0;
            var label = "";
            var redLabel = "";

            $('#total_productos').text('');
            $('#gran_total').text('');
            $('#redLabel').html('');
            if(obj.cupon.Cupon.cupon != null){
                monto = parseFloat(obj.cupon.Cupon.monto);
                if(obj.cupon.Cupon.tipo_descuento == 1){//descuento en monto directo
                    descuento = monto;
                    label += '- $' + monto.toFixed(2) + ' pesos';
                }else{//descuento en porcentaje
                    descuento = total * (monto/100);
                    label += "- " + monto + "%";
                }
                //checar un cambio de variable para el gran total. 
                totalDescuento = total - descuento;
            }
            $('#total_productos').text('$' + dinero(total,false,1)+0);
            $('#gran_total').text('$' + dinero(totalDescuento,false,1)+0);
            redLabel += obj.cupon.Cupon.cupon + "</br><small style='color:red'>"+label+"</small>" +
                "<span style='color:red'>" +
                descuento.toFixed(2) + 
                "</span>";
            $('#redLabel').html(redLabel);
        }
    });
}

function carrito(){
    $('#tabla-carrito').html('');
    //console.log(carrito_front.Productos);
	var unidad = "";
    var total = 0;
    var Tcont = "";
    var subtotal = 0;
    var img = "";
    $.each(carrito_front.Productos, function(i,elemento){
        unidad = '<span>'+elemento.pedidos_productos.cantidad_solicitada+'</span>' +'/'+'<span>'+elemento.pedidos_productos.unidad_solicitada+'</span>';
        img = elemento.fotografia;
        subtotal = Number(elemento.pedidos_productos.monto_solicitado) + Number(elemento.pedidos_productos.iva_solicitado) + Number(elemento.pedidos_productos.ieps_solicitado);
        Tcont += 
        '<tr>' +
        '<td class="product-name">' + '<img src="'+img+'" style="width:100px" alt="">' + '</td>' +
        '<td class="product-name">' + elemento.nombre + '</td>' +
        '<td class="product-name">' + unidad + '</td>' +
        //'<select class="form-control" id="unidad" name="data[Pedido][unidad]">' +
        //'<option selected="" value="'+elemento.unidad_principal+'">'+elemento.unidad_principal+'</option>';
        //if(elemento.unidad_secundaria != ""){
            //Tcont += '<option selected="" value="'+elemento.unidad_secundaria+'">'+elemento.unidad_secundaria+'</option>';
        //}
        //Tcont += 
        //'</select>' + '</td>' +
        '<td class="product-subtotal">' + dinero(subtotal,false,1)+0 + '</td>' +
        '<td class="product-name">' + '<button class="btn btn-outline-info" onclick="objeto_edit('+elemento.pedidos_productos.producto_id+','+elemento.pedidos_productos.pedido_id+')"><i class="far fa-edit"></i></button>' +
		'<button class="btn btn-outline-danger" onclick="delete_product('+elemento.pedidos_productos.id+')"><i class="fa fa-trash"></i></button>' +
        '</td>' + 
        '</tr>';
        total = total + Number(subtotal);
		console.log('hola');
    });
    $('#tabla-carrito').append(Tcont);
    $('#total_productos').text('$' + dinero(total,false,1)+0);
    $('#gran_total').text('$' + dinero(total,false,1)+0);
    $('#redLabel').text('Sin cupón');
}

function delete_product(id_producto){ 
    $.ajax({
        'url' : base_url + 'pedidos/deleteProduct',
        'type' : 'post',
	'data' : {'id' : id_producto},
        'datatype' : 'json',
        'success' : function(obj){
            if(obj.resultado == true){
                swal.fire({
                    'icon' : 'success',
                    'title' : 'Tu producto se ha eliminado correctamente',
                })
                $('#tabla-carrito').html("");
				
				datos();
                recargar_datos();
				mini_canasta();
				
            }else{
                swal.fire({
                    'icon' : 'error',
                    'title' : 'No se pudo eliminar el producto',
                })
            }
        }
    })
}
	
function edit_product(id_producto){
	$('#cantidad').unbind(); 
	$('#cantidad').inputSpinner('destroy');
	$('#editar_producto').modal('show');
	$('#unidad').html('');
	$('#img-producto').html('');
	$('#cantidad').val(0);
	$('#subtotal').val(0);
	$('#producto').text('');
	$('#alerta-existencias').html('');
	var options = ""; 
	var conversion = 0;
	var contador = 0;
	var nuevo_total = 0;
	var cantidad = 0;
	var bandera = 0;
	var conversion_precio = 0;
	var conversion_peso = 0;
	$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
	$.ajax({
		'url' : base_url + 'pedidos/traer_producto',
		'type' : 'post',
		'data' : {'id_producto':id_producto},
		'datatype' : 'json',
		'success' : function(obj){
			$('#id_carrito').val(obj.PedidosProducto.id);
			$('#img-producto').attr('src',base_url+obj.Producto.fotografia);
			//quitar precio unitario
			$('#cantidad').val(obj.PedidosProducto.cantidad_solicitada);
			$('#subtotal').val((Number(obj.PedidosProducto.monto_solicitado) + Number(obj.PedidosProducto.iva_solicitado) + Number	(obj.PedidosProducto.ieps_solicitado)).toFixed(2));
			$('#producto').text(obj.Producto.nombre);
			if(obj.Producto.tasa_iva == 16){
				$('#ieps').val(0);
				$('#iva').val((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta);
				$('#subtotal1').val(obj.Producto.precio_venta);
			}else if(obj.Producto.tasa_ieps == 8){
				$('#ieps').val((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta);
				$('#iva').val(0);
				$('#subtotal1').val(obj.Producto.precio_venta);
			}else{
				$('#ieps').val(0);
				$('#iva').val(0);
				$('#subtotal1').val(Number(obj.PedidosProducto.monto_solicitado));
			}
			$('#alerta-existencias').html('');
			options += "<option disabled>Selecciona una unidad</option>";
			switch(obj.PedidosProducto.unidad_solicitada){ 
					case 'Pieza':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad').html('');
						$('#cantidad').removeAttr('min');
						$('#cantidad').attr('min',1);
						$('#cantidad').removeAttr('step');
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
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
						conversion_peso = obj.Producto.conversion;
					break;
					
					case 'Kg': 
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta;
						console.log(conversion_precio);
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad').html('');
						$('#cantidad').removeAttr('min');
						$('#cantidad').attr('min',1);
						$('#cantidad').removeAttr('step');
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
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
						conversion_peso = 1;
					break;
					
					case 'Gr':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad').html('');
						$('#cantidad').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad').attr('min',100);
						$('#cantidad').attr('step',50);
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
						conversion_peso = obj.Producto.conversion;
					break;
					
					case 'Manojo':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
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
						conversion_peso = obj.Producto.conversion;
					break;
			} 
			$('#cantidad').unbind();
			$('#cantidad').on('input', function (event) {
					cantidad = $('#cantidad').val() * conversion_peso; 
					console.log(cantidad);
					nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					if(parseFloat(cantidad) > parseFloat(obj.Producto.inventario)){
						bandera = 1;
						$('#cantidad').val(obj.Producto.inventario * conversion_peso);
						nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						console.log(nuevo_total);
					}else{
						bandera = 0;
						$('#alerta-existencias').html('');
						nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					}
					
					if(bandera == 1){
						alerta_existencias = '<div class="alert alert-danger" role="alert">La cantidad solicitada excede los productos de inventario</div>';
						$('#alerta-existencias').html(alerta_existencias);
						bandera = 0;
					}
					contador = contador + parseFloat(cantidad);
					$('#subtotal').val(dinero(nuevo_total,false,1));
					if(obj.Producto.tasa_iva == 16){
						$('#ieps').val(0);
						$('#iva').val(nuevo_total*0.16);
						$('#subtotal1').val(nuevo_total - (nuevo_total*0.16));
					}else if(obj.Producto.tasa_ieps == 8){  
						$('#ieps').val(nuevo_total*0.08);
						$('#iva').val(0);
						$('#subtotal1').val(nuevo_total - (nuevo_total*0.08));
					}else{
						$('#ieps').val(0);
						$('#iva').val(0);
						$('#subtotal1').val(nuevo_total);
					}
			});
			
			$('#unidad').prepend(options);
			$('#unidad').unbind();
			$('#unidad').on('change',function(){
				$('#subtotal').val(0);
				var valor = 0;
				var cantidad = 0;
				var iva_solicitado = 0;
				var ieps_solicitado = 0;
				nuevo_total = 0;
				var unidad = $('#unidad').val();
				switch(unidad){ 
					case 'Pieza':
						console.log(obj.PedidosProducto.unidad_solicitada);
						conversion_precio = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(1);
						$('#cantidad').removeAttr('min');
						$('#cantidad').attr('min',1);
						$('#cantidad').removeAttr('step');
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
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
						conversion_peso = obj.Producto.conversion;
						nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(obj.Producto.tasa_iva == 16){
							$('#ieps').val(0);
							$('#iva').val(nuevo_total*0.16);
							$('#subtotal1').val(nuevo_total - (nuevo_total*0.16));
						}else if(obj.Producto.tasa_ieps == 8){  
						$('#ieps').val(nuevo_total*0.08);
						$('#iva').val(0);
						$('#subtotal1').val(nuevo_total - (nuevo_total*0.08));
						}else{
							$('#ieps').val(0);
							$('#iva').val(0);
							$('#subtotal1').val(nuevo_total);
						}
					break;
					
					case 'Kg': 
						console.log(unidad);
						conversion_precio = obj.Producto.precio_venta;
						console.log(conversion_precio);
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(1);
						$('#cantidad').removeAttr('min');
						$('#cantidad').attr('min',1);
						$('#cantidad').removeAttr('step');
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						if(obj.Producto.unidad_secundaria == ''){
							options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>";
						}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_secundaria){
							options += "<option value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
							"<option selected value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}else if(obj.PedidosProducto.unidad_solicitada == obj.Producto.unidad_principal){
							options += "<option selected value='"+obj.Producto.unidad_principal+"'>"+obj.Producto.unidad_principal+"</option>" +
							"<option value='"+obj.Producto.unidad_secundaria+"'>"+obj.Producto.unidad_secundaria+"</option>";
						}
						conversion_peso = 1;
						nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(obj.Producto.tasa_iva == 16){ 
							$('#ieps').val(0);
							$('#iva').val(nuevo_total*0.16);
							$('#subtotal1').val(nuevo_total - (nuevo_total*0.16));
						}else if(obj.Producto.tasa_ieps == 8){  
							$('#ieps').val(nuevo_total*0.08);
							$('#iva').val(0);
							$('#subtotal1').val(nuevo_total - (nuevo_total*0.08));
						}else{
							$('#ieps').val(0);
							$('#iva').val(0);
							$('#subtotal1').val(nuevo_total);
						}
					break;
					
					case 'Gr':
						console.log(unidad);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(100);
						$('#cantidad').val(obj.PedidosProducto.cantidad_solicitada);
						$('#cantidad').attr('min',100);
						$('#cantidad').attr('step',50);
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
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
						conversion_peso = obj.Producto.conversion;
						nuevo_total = $('#cantidad').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(obj.Producto.tasa_iva == 16){
							$('#ieps').val(0);
							$('#iva').val(nuevo_total*0.16);
							$('#subtotal1').val(nuevo_total - (nuevo_total*0.16));
						}else if(obj.Producto.tasa_ieps == 8){  
							$('#ieps').val(nuevo_total*0.08);
							$('#iva').val(0);
							$('#subtotal1').val(nuevo_total - (nuevo_total*0.08));
						}else{
							$('#ieps').val(0);
							$('#iva').val(0);
							$('#subtotal1').val(nuevo_total);
						}
					break;
					
					case 'Manojo':
						$('#cantidad').inputSpinner('destroy');
						$('#cantidad').val(1);
						$('#cantidad').removeAttr('min');
						$('#cantidad').attr('min',1);
						$('#cantidad').removeAttr('step');
						$('#cantidad').inputSpinner({buttonsOnly: true, autoInterval: undefined});
						console.log(unidad);
						conversion = obj.Producto.precio_venta * obj.Producto.conversion;
						console.log(conversion_precio);
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
						conversion_peso = obj.Producto.conversion;
						nuevo_total = $('#cantidad').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
					break;
				} 
				
				$('#cantidad').unbind();
				$('#cantidad').on('input', function (event) {
						cantidad = $('#cantidad').val() * conversion_peso; 
						console.log(cantidad);
						nuevo_total = ($('#cantidad').val() * conversion_peso) * (Number(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						if(parseFloat(cantidad) >= parseFloat(obj.Producto.inventario)){
							bandera = 1;
							$('#cantidad').val(obj.Producto.inventario * conversion_peso);
							nuevo_total = $('#cantidad').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
							console.log(nuevo_total);
						}else{
							bandera = 0;
							$('#alerta-existencias').html('');
							nuevo_total = $('#cantidad').val() * conversion_peso * (parseFloat(obj.Producto.precio_venta) + Number((obj.Producto.tasa_iva/100)*obj.Producto.precio_venta) + Number((obj.Producto.tasa_ieps/100)*obj.Producto.precio_venta));
						}
						
						if(bandera == 1){
							alerta_existencias = '<div class="alert alert-danger" role="alert">La cantidad solicitada excede los productos de inventario</div>';
							$('#alerta-existencias').html(alerta_existencias);
							bandera = 0;
						} 
						contador = contador + parseFloat(cantidad);
						$('#subtotal').val(dinero(nuevo_total,false,1)); 
						contador = contador + parseFloat(cantidad);
				$('#subtotal').val(dinero(nuevo_total,false,1));
				if(obj.Producto.tasa_iva == 16){
					$('#ieps').val(0);
					$('#iva').val(nuevo_total*0.16);
					$('#subtotal1').val(nuevo_total - (nuevo_total*0.16));
				}else if(obj.Producto.tasa_ieps == 8){  
					$('#ieps').val(nuevo_total*0.08);
					$('#iva').val(0);
					$('#subtotal1').val(nuevo_total - (nuevo_total*0.08));
				}else{
					$('#ieps').val(0);
					$('#iva').val(0);
					$('#subtotal1').val(nuevo_total);
				}
				});
				
				$('#subtotal').val(dinero(nuevo_total,false,1));
				datos();
			}); 	
		}
	})
}

