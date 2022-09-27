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
    <h1>NOSOTROS</h1>
</div>
<div style="padding:5% 20%" class="row">
    <div style="text-align:center" class="col-md-12">
        <?= $this->Html->image('icons/imagotipo.png',array('style'=>'width:130px'))?>
    </div>
    <div class="col-sm-12" style="text-align:center; padding:5%">
        Somos mucho más que un mercadito en línea en dónde encontrarás:
    </div>
    <div class="col-md-6" style="text-align:center; margin-bottom:30px">
        <?= $this->Html->image('icons/caja.png',array('style'=>'height:100px'))?><p style="margin-top:3em">Tus frutas y verduras frescas y de la mejor calidad.</p>
    </div>
    <div class="col-md-6" style="text-align:center; margin-bottom:30px">
        <?= $this->Html->image('icons/variedad.png',array('style'=>'height:100px'))?><p style="margin-top:3em">Una gran variedad de productos a granel como especias, granos, semillas, chiles, dulces, superfoods y más.</p>
    </div>;
</div>
<div style="padding:0% 25%" class="row">
    <div class="col-md-6" style="text-align:center; margin-bottom:30px">
        <?= $this->Html->image('icons/productos.png',array('style'=>'height:100px'))?><p style="margin-top:3em">Tus productos favoritos de despensa y hogar</p>
    </div>
    <div class="col-md-6" style="text-align:center; margin-bottom:30px">
        <?= $this->Html->image('icons/espacio.png',array('style'=>'height:100px'))?><p style="margin-top:3em">Y un gran espacio dedicado al impulso de productos artesanales hechos por emprendedores locales y mexicanos.</p>
    </div>
    <div class="col-xs-12" style='content: "";/*! position: absolute; */left: 0;bottom: -1px;width: 100%;height: 2px;background: #4fb68d;margin-top: 3em;'></div>
    
</div>

<div style="padding:5% 20% 0% 20%" class="row">
    <div class="col-xs-12 col-md-2" style="text-align:center;">
        <?= $this->Html->image('icons/imago2.png',array('style'=>'width:80%'))?>
    </div>
    <div class="col-xs-12 col-md-10">
        Somos una empresa Queretana creada en tiempos de pandemia, es por eso que buscamos impulsar a los emprendimientos mexicanos bajo el concepto de CONSUMO LOCAL, de esta forma apoyamos a aquellos emprendedores y emprendedoras sin importar el tamaño de sus empresas y/o marcas que hoy en día están creando productos únicos y especiales con la calidad y orgullo de Hecho en México.
    </div>
</div>

<div style="padding:5% 20% 0% 20%" class="row">
    <div class="col-xs-12 col-md-2" style="text-align:center;">
        <?= $this->Html->image('icons/imago2.png',array('style'=>'width:80%'))?>
    </div>
    <div class="col-xs-12 col-md-10">
        Además, DUKI es una empresa hermana de RODMAC, una comercializadora a nivel nacional de productos frescos directamente de agricultores y productores mexicanos, de esta forma nos apoyamos entre empresas para ofrecer a nuestros clientes DUKI la tranquilidad de que sus frutas y verduras cuentan con la frescura y calidad directa del campo, contribuyendo también al impulso y comercio justo de nuestras delicias agrícolas mexicanas.
    </div>
</div>

<div style="padding:5% 20% 0% 20%" class="row">
    <div class="col-xs-12 col-md-2" style="text-align:center;">
        <?= $this->Html->image('icons/imago2.png',array('style'=>'width:80%'))?>
    </div>
    <div class="col-xs-12 col-md-10">
        En DUKI no solo encontrarás marcas tradicionales para tu hogar y despensa, en DUKI también impulsarás el trabajo de los mexicanos que día a día trabajan por sus familias y por la economía de nuestro país.
    </div>
</div>

<div style="padding:5% 25% 5% 25%" class="row">
    <div class="col-xs-12 col-md-12">
        ¡Bienvenidos y bienvenidas a DUKI!
    </div>
</div>