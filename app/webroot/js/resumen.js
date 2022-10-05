$(document).ready(function(){
    
    mi_canasta(productos);
    calendario();
    $( "#cp" ).val(getCookie("Codigo_postal"));
    $('#colonia').val(getCookie("Colonia"));

    $( "#cp" ).blur(function() {
        codeAddressEdit();
        //alert($('#cp').val());
    });

    $('#colonia').blur(function(){
        codeAddressEdit();
    });

    $('#calle').blur(function(){
        codeAddressEdit();
    });

    $('#numero_interior').blur(function(){
        codeAddressEdit();
    });

    $('#numero_exterior').blur(function(){
        codeAddressEdit();
    });

    $(".input-nuevo").inputSpinner({buttonsOnly: true, autoInterval: undefined});
    $('.input-nuevo').on("input", function (event) {
        var id = $(this).closest('div').children('input.prodId').val();
        var total = $(this).closest('div').children('input.prodTotal').val();
        var unidad = $(this).closest('div').children('input.prodUnidad').val();
        var iva = $(this).closest('div').children('input.prodIva').val();
        var ieps = $(this).closest('div').children('input.prodIva').val();
        var subtotal = $(this).closest('div').children('input.prodSubtotal').val();
        var cantidad = $('#cantidad'+id).val();
        if(unidad == 'Gr'){
            cantidad = cantidad/100;
        }
        var total_unitario = (Number(iva)+Number(ieps)+Number(subtotal)); 
       
        console.log(Number(total_unitario));

        //var total_unitario = total/cantidad;
        var total_general = total_unitario * cantidad;
        $('#precio'+id).text('$'+total_general.toFixed(2)+'/'+unidad);
       
    })

    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });

    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });

    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function(){
        return false;
    })
});

function calendario(){
    $('#calendar').fullCalendar({
        defaultView: 'agendaWeek',
        defaultDate: '2019-07-09',
        buttonIcons: true,
        weekNumbers: false,
        editable: true,
        eventLimit: true,
        firstDay: 1,
        initialView: 'timeGridWeek',
        events: [
            {
                title: 'All Day Event',
                description: 'Lorem ipsum 1...',
                start: '2019-07-01',
                color: '#3A87AD',
                textColor: '#ffffff',
            }
        ],
        dayClick: function (date, jsEvent, view) {
            alert('Has hecho click en: '+ date.format());
        }, 
        eventClick: function (calEvent, jsEvent, view) {
            $('#event-title').text(calEvent.title);
            $('#event-description').html(calEvent.description);
            $('#modal-event').modal();
        },  
    });
}

let map;
let marker;
let geoLoc;
let watchID;

function myMap() {
    const myLatLng = {lat : 20.630420, lng :  -100.393203};
    var mapProp= {
        center:myLatLng,
        zoom:15,
        zoomControl: false,
        fullscreenControl: false,
        scaleControl: false,
        streetViewControl: false,
    };
    map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    marker = new google.maps.Marker({
        position :myLatLng,
        map,
        title : "Hola mundo"
    });
    codeAddress();
}

function newMarker(location){
    marker = new google.maps.Marker({
        position :location,
        map,
        title : "Hola mundo"
    });
}

function getPosition(){
    if(navigator.geolocation){
        var options = {timeout:60000};
        geoLoc = navigator.geolocation;
        watchID = geoLoc.watchPosition(showLocationOnMap,errorHandler,options);
    }else{
        alert("Lo sentimos, el explorador no soporta geolocalizacion");
    }
}

function showLocationOnMap(position){
    var latitud = position.coords.latitude;
    var longitud = position.coords.longitude;
    console.log("Latitud : " + latitud + " Longitud " + longitud);

    const myLatLng = {lat  : latitud, lng: longitud};
    marker.setPosition(myLatLng);
    map.setCenter(myLatLng);
}

function errorHandler(err){
    if(err.code == 1){
        alert("Error: Acceso denegado!");
    }else if(err.code == 2){
        alert("Error: Position no existe o no se encuentra!");
    }
}

function codeAddress() {
    var geocoder= new google.maps.Geocoder();
    var address = getCookie('Codigo_postal') + "," + getCookie('Colonia');
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
}

function codeAddressEdit(){
    var geocoder= new google.maps.Geocoder();
    var address = $('#cp').val() + "," + $('#colonia').val();
    var calle = $('#calle').val();
    var numero_exterior = $('#numero_exterior').val();
    var numero_interior = $('#numero_interior').val();
    
    if(calle != ""){
        address += ", " + $('#calle').val();
    }
    if(numero_exterior != ""){
        address += ", " + $('#numero_exterior').val();
    }
    if(numero_interior != ""){
        address += ", " + $('#numero_interior').val();
    }

    $('#mensaje_prueba').text(address);
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
          //results es el json de respuesta de google maps 
        newMarker(results[0].geometry.location);
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}


function horario(){
    $('#botones-calendario').addClass('d-none');
    $('#calendario').removeClass('d-none');
}

function volver(){
    $('#calendario').addClass('d-none');
    $('#botones-calendario').removeClass('d-none');
}

function mi_canasta(productos){
    var content = '';
    var totales = '';
    var iva_carrito = 0;
    var ieps_carrito = 0;
    var monto_carrito = 0;
    var total_producto = 0;
    var total_general = 0;
    var impuestos = 0;
    var ahorro = 0;
    var precio_venta = 0;
    var ieps = 0;
    var iva = 0;
    var subtotal = 0;
    $.each(productos,function(i, elemento){
        ieps = elemento.precio_venta*(elemento.tasa_ieps/100);
        iva = elemento.precio_venta*(elemento.tasa_iva/100);
        subtotal = elemento.precio_venta;
        iva_carrito = Number(elemento.pedidos_productos.iva_solicitado);
		ieps_carrito = Number(elemento.pedidos_productos.ieps_solicitado);
		monto_carrito = Number(elemento.pedidos_productos.monto_solicitado);
        total_producto =  iva_carrito + ieps_carrito + monto_carrito;
        total_general += total_producto;
        impuestos += iva_carrito + ieps_carrito;
        //dejar ahorro pendiente
        content += '<div class="form-row">' + 
        '<div class="col-sm-3 col-6">' + 
        '<img src="..'+elemento.fotografia+'" style="height: 110px; width: 110px;">' +
        '</div>' +
        '<div class="col-sm-3 col-6" style="margin-top:25px">' +
        '<b><h5 style="margin-left: -5%;">'+elemento.nombre+'</h5></b>' +
        '</div>'+
        '<div class="col-sm-3 col-8" style="margin-top:20px">';
        if(elemento.pedidos_productos.unidad_solicitada == 'Gr'){
            content += '<input class="form-control-sm input-nuevo" min="100" step="50" type="number" value="'+elemento.pedidos_productos.cantidad_solicitada+'" id="cantidad'+elemento.id+'">';
        }else{
            content += '<input class="form-control-sm input-nuevo" min="1" max="'+elemento.inventario+'" type="number" value="'+elemento.pedidos_productos.cantidad_solicitada+'" id="cantidad'+elemento.id+'">' ;
        }
           
        content += '<input class="prodId" hidden value="'+elemento.id+'">'+
        '<input class="prodTotal" hidden value="'+total_producto.toFixed(2)+'">'+
        '<input class="prodUnidad" hidden value="'+elemento.pedidos_productos.unidad_solicitada+'">'+
        '<input class="prodIva" hidden value="'+iva+'">'+
        '<input class="prodIeps" hidden value="'+ieps+'">'+
        '<input class="prodSubtotal" hidden value="'+subtotal+'">'+
        '</div>' +
        '<div class="col-sm-3 col-4" style="margin-top:25px">' +
            '<span id="precio'+elemento.id+'" style="color: red; margin-left: 20%;">$'+total_producto.toFixed(2)+'/'+elemento.pedidos_productos.unidad_solicitada+'</span>'+
        '</div>'+
        '<hr>' +
        '</div>';
    });
    totales += '<div class="form-row">'+
    '<div class="col-8"><span style="font-size:40px;">Impuestos Inlcuidos</span></div><br>' +
    '<div class="col-4"><span style="font-size:40px;">$'+impuestos.toFixed(2)+'</span</div><br>' +
    '</div>'+
    '<div class="col-8"><span style="font-size:40px; margin-top:5%;">Subtotal</span></div>' +
    '<div class="col-4"><span style="font-size:40px; margin-top:5%;">$'+total_general.toFixed(2)+'</span></div>';
    $('#resumen').html(content);
    $('#totales').html(totales);
}

function cambiar_precio(id,total_producto,cantidad_solicitada,unidad_solicitada){
    var cantidad_unitaria = total_producto/cantidad_solicitada;
    var cantidad = $('#cantidad'+id).val();
    var total = 0;
    total = cantidad * total_producto
    $('#precio'+id).text('$'+total.toFixed(2)+'/'+unidad_solicitada);
}