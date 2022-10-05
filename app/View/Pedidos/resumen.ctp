<style>
* {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

/*Background color*/

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;

    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
}



/*Blue Buttons*/
#msform .action-button {
    width: 100px;
    background: #20c997;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #20c997;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #000;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #000;
}

/*Dropdown List Exp Date*/
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f041";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f073";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f09d";   
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #20c997;
}

/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}

.radio {
    display:inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor:pointer;
    margin: 8px 2px; 
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}

.btn-circle.btn-sm {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    font-size: 8px;
    text-align: center;
}
.btn-circle.btn-md {
    width: 50px;
    height: 50px;
    padding: 7px 10px;
    border-radius: 25px;
    font-size: 10px;
    text-align: center;
}
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 12px;
    text-align: center;
}

.card-personalizada{
    width:50%;
    height:100%;
}

@media (max-width: 480px) {
    .card-personalizada{
        width:100%;
        height:50%;
    }
}

</style>
<script>var productos = <?= json_encode($carrito['Productos']); ?>; </script>
<?= $this->Html->css('fullcalendar')?>
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">

    <div class="row justify-content-center mt-1">
        <div class="col-12 col-sm-9 col-md-7 col-lg-9 text-center">
            <div class="card">
            <div class="cart-main-area mtb-60px">
                <div class="container">
                    <h3 class="cart-page-title">¡Un antojito no está de más!</h3>
                    <div class="row">
                        <div class="best-sell-slider owl-carousel owl-nav-style">
                            <!-- Single Item -->
                            <?php foreach($antojos as $producto):?>
                                <?= $this->Element('Productos/grid_view',array('producto'=>$producto['productos'],'tipo'=>'antojos','categoria_id'=>$antojos[0]['productos_categorias']['categoria_id']))?>
                            <?php endforeach?>
                            <!-- Single Item -->
                        </div>
                    </div>
                </div>
            </div>
                <h2><strong>Proceso de compra</strong></h2>
                <p>Realiza paso a paso tu proceso de compra</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Resumen</strong></li>
                                <li id="personal"><strong>Direccion</strong></li>
                                <li id="payment"><strong>Horario</strong></li>
                                <li id="confirm"><strong>Pago</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card" >
                                    <h2 class="fs-title">Mi canasta</h2>
                                    <div id="resumen" style=" height:350px; overflow: scroll;"></div>
                                    <hr>
                                    <div id="totales"></div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Siguiente"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Mi direccion</h2>
                                    <div id="googleMap" style="width:100%;height:200px;"></div>
                                    <h4>Ingresa tu direccion</h4><span id="mensaje_prueba"></span>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            Codigo postal
                                            <input class="form-control" placeholder="Ingresa codigo postal" id="cp">
                                        </div>
                                        <div class="col-sm-6">
                                            Colonia
                                            <input class="form-control" id="colonia">
                                        </div>
                                        <div class="col-sm-4">
                                            Calle
                                            <input class="form-control" id="calle">
                                        </div>
                                        <div class="col-sm-4">
                                            Numero exterior
                                            <input class="form-control" id="numero_exterior">
                                        </div>
                                        <div class="col-sm-4">
                                            Numero interior
                                            <input class="form-control" id="numero_interior">
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                <input type="button" name="next" class="next action-button" value="Siguiente"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2>Selecciona un horario</h2>
                                    <div class="form-row" id="botones-calendario">
                                        <div class="col-6 justify-content-center">
                                            <center><a ><img src="../img/duki/entregaExpres.jpeg" alt="Entrega Express" class="shadow card-personalizada"></center></a>
                                        </div>
                                        <div class="col-6 justify-content-center">
                                            <center><a onclick="horario()"><img src="../img/duki/entregaProgra.jpeg" alt="Entrega programada" class="shadow card-personalizada"></a></center>
                                        </div>
                                    </div>
                                    <div id="calendario"  class="d-none"><button class="btn btn-info" type="button" onclick="volver();">Volver</button><div id="calendar"></div></div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                <input type="button" name="make_payment" class="next action-button" value="Confirmar"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Selecciona el tipo de pago</h2>
                                    <div class="form-row ">
                                        <div class="col-6 justify-content-center">
                                            <center><img src="../img/duki/pagoEfectivo.jpeg" alt="Entrega Express" class="shadow card-personalizada"></center>
                                        </div>
                                        <div class="col-6 justify-content-center">
                                            <center><img src="../img/duki/pagoTarjeta.jpeg" alt="Entrega programada" class="shadow card-personalizada"></center>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                <input type="button" name="make_payment" class="next action-button" value="Confirmar"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart area end -->
<?php echo $this->fetch('postLink'); ?>
<script>
var carrito_front = <?= json_encode($carrito)?>;
var pedido = "<?= $carrito['Pedido']['id']?>";
</script>
 <?= $this->Html->script('canasta.js'); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<?= $this->Html->script('resumen')?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsuX8l3QZZY32TFBTO-4Pb-ICtj3-4TWw&callback=myMap"></script>
<?= $this->Html->script('moment.min')?>
<?= $this->Html->script('fullcalendar')?>