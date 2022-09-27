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
    .linea{
        width:40%;
        background-color:#72C6AD;
        height:3px;
        margin-top:1em
    }
</style>
<div class="fondo1"></div>
<div class="fondo2">
    <h1>FORMAS DE PAGO</h1>
</div>
<div style="padding:5% 25%" class="row">
    <div style="text-align:center" class="col-md-12">
        <?= $this->Html->image('icons/imagotipo.png',array('style'=>'width:130px'))?>
    </div>
    <div class="col-sm-12" style="text-align:center; padding:5%">
        Â¡TÃº eliges!
    </div>
    <!--<div class="col-md-4" style="text-align:center">
        <?/*= $this->Html->image('icons/tdc-tdd.png',array('style'=>'height:100px'))*/?><p style="margin-top:3em">TDC Y TDD en lÃ­nea</p>
    </div>-->
    <div class="col-md-6" style="text-align:center">
        <?= $this->Html->image('icons/tdc-tdd-contraentrega.png',array('style'=>'height:100px'))?><p style="margin-top:3em">TDC Y TDD contraentrega</p>
    </div>
    <div class="col-md-6" style="text-align:center">
        <?= $this->Html->image('icons/efectivo.png',array('style'=>'height:100px'))?><p style="margin-top:3em">Efectivo contraentrega</p>
    </div>
</div>