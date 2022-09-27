<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript' ></script>
<script src='https://pagofacil.net/ws/public/jscripts/pagofacil-3dsecure.js' type='text/javascript' ></script>

<form method="POST" id="3ds-form" name="3ds-form">
    <input name="idSucursal" type="hidden"/>
    <input name="idUsuario" type="hidden"/>
    <input name="idPedido" type="hidden" value="1" />
    <input name="idServicio" type="hidden" value="3" />

    Nombre: <input id="nombre" name="nombre" type="text" value="Gustavo" />
    Apellidos: <input id="apellidos" name="apellidos" type="text" value="Martinez Tamayo" />
    Email: <input id="email" name="email" type="text" value="gustavo.vtamayo@gmail.com" />
    Calle y Num.: <input id="calleyNumero" name="calleyNumero" type="text" value="Monterrey 170" />
    CP: <input id="cp" name="cp" type="text" value="76902" />
    Colonia: <input id="colonia" name="colonia" type="text" value="San Jose de los Olvera" />
    Municipio: <input id="municipio" name="municipio" type="text" value="Corregidora" />
    Estado: <input id="estado" name="estado" type="text" value="Queretaro" />
    Pais: <input id="pais" name="pais" type="text" value="Mexico" />
    Telefono: <input id="telefono" name="telefono" type="text" value="1234567890" />
    Celular: <input id="celular" name="celular" type="text" value="1234567890" />
    No. Tarjeta: <input id="numeroTarjeta" name="numeroTarjeta" type="text" value="4546 4000 3474 8181" />
    Mes Exp. <input id="mesExpiracion" name="mesExpiracion" type="text" value="12" />
    Año Exp. <input id="anyoExpiracion" name="anyoExpiracion" type="text" value="24" />
    CVV: <input id="cvt" name="cvt" type="text" value="123" />
    Monto: <input id="monto" name="monto" type="text" value="1234" />
    <input type="hidden" name="httpUserAgent" value="<?= $_SERVER['HTTP_USER_AGENT'] ?>" />

    <input type="submit" name="Enviar" />
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#idSucursal').val('85c5beb77893d56547e10745befa52d546054700');
		$('#idUsuario').val('5d5375f890c7dbdb4da8373d84352d63e38ebcee');
		$("#3ds-form").enviarPagoFacil3dSecure();//Metodo contenido en el archivo -pagofacil3ds.js-
	});
		
        
</script>