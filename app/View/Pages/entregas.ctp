<style>
    h1 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 1em;
        color:white;
    }
    h2 {
        font-size: 16px;
        font-weight: bold;
        margin-top: 1em;
    }
    h3 {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 1em;
        margin-top: 1em;
    }
    p{
        line-height:1.3em
    }
    .fondo1{
        width:100%;
        background-color:#5FB296;
        height:20px;
    }
    .fondo2{
        width:100%;
        background-color:#72C6AD;
        padding:4px 0px;
        text-align:center;
    }
    .col-r1{
        width:20%;
    }
    .col-r2{
        width: 40%;
        padding: 50px;
        background-color: #E8FCF4;
        border: 12px solid white;
    }
</style>
<div class="fondo1"></div>
<div class="fondo2">
<h1>Entregas</h1>
</div>
<div style="padding:5% 5%; text-align:center">
Nuestros envíos son realizados cuidadosamente para que recibas en tu hogar todos tus productos en el mejor estado y frescura,
es por eso que hemos creado una red de logística especial para nuestros clientes DUKI.
Para que tengas una increíble DUKI-Experiencia, es necesario que realices tus pedidos con anticipación dependiendo el servicio que desees:

<table style="width:100%; margin-top:50px">
    <tr>
        <td></td>
        <td><?= $this->Html->image('icons/pedidos-express.png',array('style'=>'width:100px')) ?><p style="margin-top:10px">PEDIDOS EXPRESS</p></td>
        <td><?= $this->Html->image('icons/pedidos-programados.png',array('style'=>'width:100px')) ?><p style="margin-top:10px">PEDIDOS PROGRAMADOS</p></td>
    </tr>
    <tr>
        <td class="col-r1"><b>TIEMPO DE ENTREGA</b></td>
        <td class="col-r2">Recibe tus compras en la puerta de tu hogar máximo 40 minutos después de confirmado tu pedido.</td>
        <td class="col-r2">Elige el horario de entrega que tú prefieras dentro de nuestras rutas establecidas, desde el mismo día entre 4 y 24 hrs después de confirmado tu pedido.</td>
    </tr>
    <tr>
        <td class="col-r1"><b>COSTO DE ENVÍO</b></td>
        <td class="col-r2">$69.00 MXN</td>
        <td class="col-r2">$49.00 MXN</td>
    </tr>
    <tr>
        <td class="col-r1"><b>ENTREGA GRATUITA</b></td>
        <td class="col-r2">En compra mínima de $899.00 MXN </td>
        <td class="col-r2">En compra mínima de $499.00 MXN </td>
    </tr>
</table>
</div>
<div style="padding:0% 5% 5% 5%; text-align:left">
    <h2>HORARIOS DE ENTREGA</h2>
    <ul>
        <li>Lunes a Viernes de 8 am a 9 pm</li>
        <li>Sábados y Domingos de 9 am a 5 pm</li>
    </ul>
    <h2>CONDICIONES DE ENTREGA</h2>
    <ol>
        <li>Los pedidos son programados en ruta en el horario y forma de tu selección una vez que recibas en tu correo electrónico nuestra confirmación de pedido con tu resumen de compra y número de pedido. Recuerda revisar tu bandeja de no deseados o spam.</li>
        <li>No olvides especificar las instrucciones de entrega una vez que termines tus compras (ejemplos: Dejar pedido en vigilancia. Dejar pedido en la puerta principal. Acceso por la entrada secundaria. Recibe Juan Pérez )</li>
        <li>En caso de que programes tu entrega y no te encuentres en el domicilio, podemos enviar tu pedido al día siguiente con un costo adicional de $89.00 mxn que se deberán pagar a contra entrega en efectivo o tarjeta. Es necesario notificar al número 446-139-3615</li>
        <li>Si deseas cambiar la hora de entrega de tu pedido, esta deberá ser notificada mínimo 3 horas antes de la hora seleccionada (para entregas Programadas) o 40 min antes de la entrega en caso de seleccionar una entrega Express.</li>
    </ol>
</div>